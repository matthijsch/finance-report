<?php

namespace App\Controller;

use App\Entity\Bankaccount;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

class BankaccountController
{
    /**
     * Constructor
     *
     * @param ManagerRegistry $managerRegistry
     * @param Twig_Environment $twig
     */
    public function __construct(ManagerRegistry $managerRegistry, Twig_Environment $twig)
    {
        $this->bankaccountRepository = $managerRegistry->getRepository(Bankaccount::class);
        $this->twig = $twig;
    }

    /**
     * Overview page
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
}
