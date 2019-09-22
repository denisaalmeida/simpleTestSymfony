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

        $request = Request::createFromGlobals();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            var_dump($data);
            die;
        }
        return $this->render('create_account/index.html.twig', [
            'form' => $form->createView(),
            'formUser' => $formUser->createView(),
            'formAddress' => $formAddresses->createView()
        ]);
    }

    /**
     * @Route("/create/account/Save", name="createAcountSave")
     */
    public function createAcount()
    {
        echo "Aloooo";
        $request = Request::createFromGlobals();
        print_r($request);
        die;
    }
}
