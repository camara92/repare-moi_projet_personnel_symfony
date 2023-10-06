<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PeintureRepository $peintureRepository, BlogpostRepository $blogpostRepository): Response
    {
        // les trois dernières peintures : 

        return $this->render('home/index.html.twig', [
            'peintures' => $peintureRepository->lastTree(),
            'realisations'=>$blogpostRepository->AffichersDerniersRealisations()
        ]);
    }
}
