<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FileUploadType;


class ArticleCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('title'),
            ImageField::new('image')
    ->setBasePath('uploads/') // Optional: The base path for displaying images
    ->setUploadDir('public/assets'), // Specify the directory where images will be uploaded

            TextareaField::new('content'),
            MoneyField::new('prix')
            ->setCurrency('EUR'), // Specify the currency for the money field (e.g., EUR, USD, etc.)
        
            AssociationField::new('categorie')


        ];
    }
    
}


