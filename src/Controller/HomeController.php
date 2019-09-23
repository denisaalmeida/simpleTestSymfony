<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    public function index()
    {
        $accountUser = new User();

        $form = $this->createForm(\App\Form\LoginFormType::class, $accountUser);

        $request = Request::createFromGlobals();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $repository = $this->getDoctrine()->getRepository(User::class);
            $accountUser = $repository->findOneBy(["username" => $accountUser->getUsername(), "password" => $accountUser->getPassword()]);
            if (!$accountUser) {
                $this->addFlash(
                    'error',
                    'Usuário ou senha Inválidos'
                );
                return $this->redirectToRoute('login');
            }
            return $this->redirectToRoute('login');
        }
        return $this->render('login/login.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
