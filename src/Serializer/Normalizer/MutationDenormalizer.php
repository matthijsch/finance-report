<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use DateTime;
use App\Entity\Mutation;
use App\Entity\MutationAccount;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectRepository;

class MutationDenormalizer implements DenormalizerInterface
{
    /**
     * @var ObjectRepository
     */
    private $mutationAccountRepository;

    /**
     * Constructor.
     *
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->mutationRepository = $managerRegistry->getRepository(Mutation::class);
        $this->mutationAccountRepository = $managerRegistry->getRepository(MutationAccount::class);
    }

    /**
     * Denormalizes data back into an object of the given class.
     *
     * @param mixed  $data    Data to restore
     * @param string $class   The expected class to instantiate
     * @param string $format  Format the given data was extracted from
     * @param array  $context Options available to the denormalizer
     */
    public function denormalize($data, $class, $format = null, array $context = []): Mutation
    {
        $id = $this->denormalizeId($data);

        $mutation = $this->mutationRepository->findOneBy(['id' => $id]);

        if (!$mutation instanceof Mutation) {
            $mutation = new Mutation();
            $mutation->setId($id);
        }

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'Bedrag (EUR)':
                    $mutation->setAmount($this->denormalizeAmount($value, $data['Af Bij']));
                    break;
                case 'Datum':
                    $mutation->setDate($this->denormalizeDate($value));
                    break;
                case 'Naam / Omschrijving':
                    $mutation->setMutationAccount($this->denormalizeCompany($value));
                    break;
            }
        }

        return $mutation;
    }

    /**
     * Checks whether the given class is supported for denormalization by this normalizer.
     *
     * @param mixed  $data   Data to denormalize from
     * @param string $type   The class to which the data should be denormalized
     * @param string $format The format being deserialized from
     */
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return is_array($data);
    }

    /**
     * Denormalize id.
     *
     * @param array $data
     */
    private function denormalizeId(array $data): string
    {
        return md5(implode('', $data));
    }

    /**
     * Denormalize amount.
     *
     * @param string $amount
     * @param string $substractOrAdd
     */
    private function denormalizeAmount(string $amount, string $substractOrAdd): int
    {
        $amount = preg_replace('/[^\d]/', '', $amount);

        if ('Af' === $substractOrAdd) {
            return $amount * -1;
        }

        return $amount;
    }

    /**
     * Denormalize date.
     *
     * @param string $date
     */
    private function denormalizeDate(string $date): DateTime
    {
        return DateTime::createFromFormat('Ymd', $date);
    }

    /**
     * Denormalize company.
     *
     * @param string $company
     */
    private function denormalizeCompany(string $company): MutationAccount
    {
        static $mutationAccounts = [];

        if (isset($mutationAccounts[$company])) {
            $mutationAccount = $mutationAccounts[$company];
        } else {
            $mutationAccount = $this->mutationAccountRepository->findOneBy([
                'company' => $company,
            ]);

            if (!$mutationAccount instanceof MutationAccount) {
                $mutationAccount = new MutationAccount();
                $mutationAccount->setCompany($company);
                $mutationAccount->setCategory('other');
            }

            $mutationAccounts[$company] = $mutationAccount;
        }

        return $mutationAccount;
    }
}
