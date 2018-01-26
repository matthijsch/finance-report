<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $mutations = new ArrayCollection();
        $mutationAccounts = [];

        foreach ($data as $mutationArray) {
            $company = $mutationArray['Naam / Omschrijving'];

            if (isset($mutationAccounts[$company])) {
                $mutationAccount = $mutationAccounts[$company];
            } else {
                $mutationAccount = $this->mutationAccountRepository->findOneBy([
                    'company' => $company,
                ]);

                if (!$mutationAccount instanceof MutationAccount) {
                    $mutationAccount = new MutationAccount();
                    $mutationAccount->setCompany($mutationArray['Naam / Omschrijving']);
                    $mutationAccount->setCategory('other');
                }

                $mutationAccounts[$company] = $mutationAccount;
            }

            $mutation = new Mutation();
            $mutation->setAmount(preg_replace('/[^\d]/', '', $mutationArray['Bedrag (EUR)']));
            $mutation->setDate(DateTime::createFromFormat('Ymd', $mutationArray['Datum']));
            $mutation->setMutationAccount($mutationAccount);

            $mutations->add($mutation);
        }

        return $mutations;
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
}
