<?php

namespace App\Controller;

use App\Service\PanierService;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticlesRepository $article, PanierService $panierService): Response
    {   
        $computers = $article->findbyComputer("computers",'laptop','macOs');

        $panier = $panierService->getPanier();
        $notifications=$panierService->getNotifications($panier);

        $prixPanier = $panierService->calculerPrixPanier($panier);

        return $this->render('index.html.twig',[
            'articles'=>$article->findAll(),
            'computers'=>$computers,
            'panier'=>$panier,
            'prixPanier'=>$prixPanier,
            'notifications'=>$notifications
        ]);
    }
    /**
     * @Route("/panier/", name="panier")
     */
    public function Panier(ArticlesRepository $article,SessionInterface $session, PanierService $service)
    {
        $panier=$service->getPanier();

        $totales=$service->calculerPrixPanier($panier);
        $notifications=$service->getNotifications($panier);



        return $this->render('panier.html.twig',
            [
                'panier'=>$panier,
                'prixPanier'=>$totales,
                'notifications'=>$notifications
            ]
        );
    }
 
    
}

