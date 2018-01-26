<?php

namespace App\Controller;

use App\Entity\MutationAccount;
use App\Form\Type\MutationAccountType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

class MutationAccountController
{
    /**
     * @var ObjectRepository
     */
    private $mutationAccountRepository;

    /**
     * @var ObjectManager
     */
    private $mutationAccountManager;

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * Constructor.
     *
     * @param ManagerRegistry      $managerRegistry
     * @param Twig_Environment     $twig
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        Twig_Environment $twig,
        FormFactoryInterface $formFactory
    ) {
        $this->mutationAccountRepository = $managerRegistry->getRepository(MutationAccount::class);
        $this->mutationAccountManager = $managerRegistry->getManagerForClass(MutationAccount::class);

        $this->twig = $twig;
        $this->formFactory = $formFactory;
    }

    /**
     * Overview mutationAccounts.
     *
     * @param Request $request
     */
    public function indexAction(Request $request): Response
    {
        $mutationAccounts = $this->mutationAccountRepository->findAll();

        return new Response(
            $this->twig->render(
                'pages/mutationAccount/index.html.twig',
                ['mutationAccounts' => $mutationAccounts]
            )
        );
    }

    /**
     * Update mutationAccount.
     *
     * @param MutationAccount $mutationAccount
     * @param Request         $request
     */
    public function updateAction(MutationAccount $mutationAccount, Request $request): Response
    {
        $form = $this->formFactory->create(MutationAccountType::class, $mutationAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mutationAccount = $form->getData();

            $this->mutationAccountManager->persist($mutationAccount);
            $this->mutationAccountManager->flush();
        }

        return new Response(
            $this->twig->render(
                'pages/mutationAccount/edit.html.twig',
                ['form' => $form->createView()]
            )
        );
    }
}
