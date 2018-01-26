<?php

namespace App\Controller;

use App\Entity\Mutation;
use App\Form\Type\MutationsImportType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use App\Import\MutationImporter;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MutationController
{
    /**
     * @var ObjectRepository
     */
    private $mutationRepository;

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var MutationImporter
     */
    private $mutationImporter;

    /**
     * Constructor.
     *
     * @param ManagerRegistry      $managerRegistry
     * @param Twig_Environment     $twig
     * @param FormFactoryInterface $formFactory
     * @param MutationImporter     $mutationImporter
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        Twig_Environment $twig,
        FormFactoryInterface $formFactory,
        MutationImporter $mutationImporter
    ) {
        $this->mutationRepository = $managerRegistry->getRepository(Mutation::class);

        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->mutationImporter = $mutationImporter;
    }

    /**
     * Overview mutations.
     *
     * @param Request $request
     */
    public function indexAction(Request $request): Response
    {
        $mutations = $this->mutationRepository->findAll();

        $form = $this->formFactory->create(MutationsImportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            if ($formData['file'] instanceof UploadedFile) {
                $this->mutationImporter->import($formData['file']);
            }
        }

        return new Response(
            $this->twig->render(
                'pages/mutation/index.html.twig',
                ['form' => $form->createView()]
            )
        );
    }
}
