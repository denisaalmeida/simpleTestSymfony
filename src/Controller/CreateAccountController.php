<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Entity\AccountsUsers;
use App\Entity\Addresses;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CreateAccountController extends AbstractController
{
    /**
     * @Route("/create/account", name="create_account")
     */
    public function index()
    {
        $account = new Accounts();
        $accountUser = new AccountsUsers();
        $accountAddress = new Addresses();

        $form = $this->createForm(\App\Form\AccountCreateType::class, $account);
        $formUser = $this->createForm(\App\Form\AccountUsersType::class, $accountUser);
        $formAddresses = $this->createForm(\App\Form\AccountAddressesType::class, $accountAddress);

        return $this->render('create_account/index.html.twig', [
            'form' => $form->createView(),
            'formUser' => $formUser->createView(),
            'formAddress' => $formAddresses->createView()
        ]);
    }

    public function createAcount()
    { }
}
