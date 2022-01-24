<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticlesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Articles::class;
    }

    /**
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('articleName')->setLabel('Product Name'),
            TextField::new('brand'),
            ImageField::new('pictureArticle')->setUploadDir("public/product"),
            ImageField::new('picturesPanier')->setUploadDir("public/panier"),

            AssociationField::new('category'),
            IntegerField::new('price')
            // TextField::new('title'),
            // TextEditorField::new('description'),
        ];
    }
    
}
