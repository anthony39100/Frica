<?php

namespace App\Controller;

use App\Entity\Articles;

use App\Service\PanierService;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier/add/{id}", name="addpanier")
     */
    public function index($id,SessionInterface $session): Response
    {
        $panier=$session->get('panier',[]);
        //on recupere un panier vide 
        if(!empty($panier[$id])){
            $panier[$id]++;
           
            //si l'article avec l'id  n'est pas vide on ajoute des quantités
        }else{
            $panier[$id]=1;
            //sinon on ajoute une quantité 

        }
      
        $session->set('panier',$panier);
     
   
        //on enregistre nos articles avec leurs id 
         return $this->redirectToRoute('home');
        //on retourne dans la page home
   
    }


  
    /**
    * @Route("/panier/{id}", name="supprimer")
    */
    public function DeleteArticle($id,SessionInterface $session)
    {

        $panierItems=$session->get('panier');

        if(!empty($panierItems[$id])){
            unset($panierItems[$id]);
        }
        $session->set('panier',$panierItems);

        return $this->redirectToRoute('panier');
    }

       /**
    * @Route("/addquantite/{id}", name="addquantite")
    */
    public function addQuantite($id,SessionInterface $session)
    {

        $panier=$session->get('panier');
        if(!empty($panier[$id])){
            $panier[$id]++;
        }
        $session->set('panier',$panier);
        return $this->redirectToRoute('panier');
    }
    
       /**
    * @Route("/lessquantite/{id}", name="lessquantite")
    */
    public function lessQuantite($id,SessionInterface $session)
    {

        $panier=$session->get('panier');
        if(!empty($panier[$id]) && $panier[$id]>1){
            $panier[$id]--;
        }
        $session->set('panier',$panier);
        return $this->redirectToRoute('panier');
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