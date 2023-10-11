<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController
{
    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(UserRepository $userRepository): Response
    {

        return $this->render('apropos/apropos.html.twig', [
            'peintre' => $userRepository->getPeintre()
        ]);
    }
}
