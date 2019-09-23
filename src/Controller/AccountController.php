<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Entity\User;
use App\Entity\Addresses;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    protected $entityManager;

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/create/account", name="create_account")
     */
    public function create()
    {
        $account = new Accounts();
        $accountUser = new User();
        $accountAddress = new Addresses();

        $form = $this->createForm(\App\Form\AccountCreateType::class, $account);
        $formUser = $this->createForm(\App\Form\UserType::class, $accountUser);
        $formAddresses = $this->createForm(\App\Form\AccountAddressesType::class, $accountAddress);

        $request = Request::createFromGlobals();

        $form->handleRequest($request);
        $formUser->handleRequest($request);
        $formAddresses->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $account = $this->createAcount($form->getData());
            $this->createUser($formUser->getData(), $account);
            $this->saveAddress($formAddresses->getData(), $account);
            $this->addFlash(
                'notice',
                'Cadastro Salvo!'
            );
            return $this->redirectToRoute('home');
        }

        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
            'formUser' => $formUser->createView(),
            'formAddress' => $formAddresses->createView()
        ]);
    }

    protected function getEntityManager()
    {
        if (is_null($this->entityManager)) {
            $this->entityManager = $this->getDoctrine()->getManager();
        }
        return $this->entityManager;
    }


    private function createAcount(Accounts $account)
    {
        try {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($account);
            $entityManager->flush();
            return $account;
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                'Houve uma falha'
            );
        }
    }

    private function createUser(User $accountUser, Accounts $account)
    {
        try {
            $accountUser->setAccountId($account);
            $accountUser->setPassword($this->passwordEncoder->encodePassword(
                $accountUser,
                $accountUser->getPassword()
            ));
            $roles = json_encode(['ROLES_DEFAULT']);
            $accountUser->setRoles($roles);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accountUser);
            $entityManager->flush();
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                'Houve uma falha'
            );
        }
    }

    private function saveAddress(Addresses $addresses, Accounts $account)
    {

        $entityManager = $this->getEntityManager();
        $entityManager->persist($addresses);
        $entityManager->flush();
        //} catch (Exception $e) {
        //var_dump($e->getCode());
        //  die;
        $this->addFlash(
            'error',
            'Houve uma falha'
        );
        //}
    }
}
