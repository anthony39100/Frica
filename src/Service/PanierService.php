<?php
namespace App\Service;

use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService {
    private $session;
    private $article;
    public function __construct(SessionInterface $session, ArticlesRepository $article){
       $this->session = $session;
       $this->article = $article;
    }

    /**
     * @return array
     */
    public function getPanier(): array
    {
        $panier = $this->session->get('panier',[]);
        $panierCurrentArticle=[];
        foreach($panier as $articleId => $quantite){

            $panierCurrentArticle[]=[
                'produit'=>$this->article->find($articleId),
                'quantite'=>$quantite
            ];
        }
        $panier = $panierCurrentArticle;

        return $panier;
    }

    /**
     * @param $panier
     * @return float|int
     */
    public function calculerPrixPanier($panier){
        $prixPanier = 0;
        foreach($panier as $article){
            $prixArticle = $article['quantite']*$article['produit']->getPrice();
            $prixPanier += $prixArticle;
        }
        return $prixPanier;
    }

    /**
     * @param $panier
     * @return int|mixed
     */
    public  function  getNotifications($panier){
        $notifications = 0;
        foreach($panier as $article){
            $notificationPanier =  $article['quantite'];
            $notifications += $notificationPanier;
        }
        return $notifications;
    }
}


?>