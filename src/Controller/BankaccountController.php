<?php

/*
 * This file is part of the JMT catalog package.
 *
 * (c) Connect Holland.
 */

namespace App\Controller;

use App\Entity\Bankaccount;
use App\Form\Type\BankaccountType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

class BankaccountController
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

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
        $this->bankaccountRepository = $managerRegistry->getRepository(Bankaccount::class);
        $this->twig                  = $twig;
        $this->formFactory           = $formFactory;
    }

    /**
     * Overview bankaccounts.
     *
     * @param Request $request
     */
    public function overviewAction(Request $request): Response
    {
        $bankaccounts = $this->bankaccountRepository->findAll();

        return new Response(
            $this->twig->render(
                'pages/bankaccount/index.html.twig',
                ['bankaccounts' => $bankaccounts]
            )
        );
    }

    /**
     * Update bankaccount.
     *
     * @param Bankaccount $bankaccount
     * @param Request     $request
     */
    public function updateAction(Bankaccount $bankaccount, Request $request): Response
    {
        $form = $this->formFactory->create(BankaccountType::class, $bankaccount);
        $form->handleRequest($request);

        return new Response(
            $this->twig->render(
                'pages/bankaccount/edit.html.twig',
                ['form' => $form->createView()]
            )
        );
    }
}
