<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\HttpFoundation\RequestStack;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\String\Slugger\SluggerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductsCrudController extends AbstractCrudController
{

    public function determineUploadDir(SluggerInterface $slugger): string
    {
        // Customize the logic to determine the dynamic upload directory
        // Here, we are using the slug of the 'titre' property as part of the directory
        $slug = $slugger->slug($this->getParameter('id'))->lower();
        return 'public/assets/uploads/avatar/img/' . $slug;
    }

    public static function getEntityFqcn(): string
    {
        return Products::class;
    }


    
    public function configureFields(string $pageName): iterable
    {
        

        return [
        
            TextField::new('date_innmat'),
            NumberField::new('km'),
            TextField::new('titre'),
            TextField::new('description'),
            ImageField::new( 'pictures')
             ->setUploadDir('public/assets/')
             ->setBasePath('uploads/avatar/img')
             ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
        ];
    }
    
}
