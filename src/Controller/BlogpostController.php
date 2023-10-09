<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogpostController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualites')]
    public function Actualites(BlogpostRepository $blogpostRepository, PaginatorInterface $paginator , Request $request): Response
    {
        $data= $blogpostRepository->findAll(); 
        $blogposts = $paginator->paginate($data, $request->query->getInt('page', 1)
    , 9
    );
        return $this->render('blogpost/actualites.html.twig', [
            'controller_name' => 'BlogpostController',
            'blogposts' => $blogposts,
        ]);
    }
}
