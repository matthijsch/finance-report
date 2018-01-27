<?php

namespace App\Import;

use App\Entity\Mutation;
use App\Serializer\Normalizer\MutationDenormalizer;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class MutationImporter
{
    /**
     * @var MutationDenormalizer
     */
    private $mutationDenormalizer;

    /**
     * @var ObjectManager
     */
    private $mutationtManager;

    /**
     * Constructor.
     *
     * @param MutationDenormalizer $mutationDenormalizer
     * @param ManagerRegistry      $managerRegistry
     */
    public function __construct(MutationDenormalizer $mutationDenormalizer, ManagerRegistry $managerRegistry)
    {
        $this->mutationDenormalizer = $mutationDenormalizer;
        $this->mutationManager = $managerRegistry->getManagerForClass(Mutation::class);
    }

    public function import(UploadedFile $file)
    {
        $serializer = new Serializer(
            [new ArrayDenormalizer(), $this->mutationDenormalizer],
            [new CsvEncoder()]
        );

        $fileContents = file_get_contents($file->getPathname());
        $mutations = $serializer->deserialize($fileContents, 'App\Entity\Mutation[]', 'csv');

        foreach ($mutations as $mutation) {
            if ($mutation instanceof Mutation) {
                $this->mutationManager->persist($mutation);
            }
        }

        $this->mutationManager->flush();
    }
}
