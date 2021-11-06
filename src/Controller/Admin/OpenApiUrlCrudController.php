<?php

namespace App\Controller\Admin;

use App\Entity\OpenApiUrl;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpenApiUrlCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return OpenApiUrl::class;
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Openapi list')
                    ->setPageTitle('new', 'Create new openapi link')
                    ->setPageTitle('detail', fn(OpenApiUrl $url) => $url->getTitle())
                    ->setPageTitle('edit', fn(OpenApiUrl $url) => sprintf('Edit "%s"', $url->getTitle()))
        ;
    }

    /**
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('url'),
            TextField::new('title'),
            AssociationField::new('recipientList')->setLabel('Recipient list'),
        ];
    }
}
