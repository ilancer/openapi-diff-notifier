<?php

namespace App\Controller\Admin;

use App\Entity\History;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HistoryCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return History::class;
    }

    /**
     * @param Actions $actions
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Action::INDEX, Action::NEW)
                       ->remove(Action::INDEX, Action::DELETE)
                       ->remove(Action::INDEX, Action::EDIT)
                       ->remove(Action::DETAIL, Action::DELETE)
                       ->remove(Action::DETAIL, Action::EDIT)
                       ->add(Action::INDEX, Action::DETAIL)
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
            AssociationField::new('openApi')->setDisabled(true)->setLabel('Openapi'),
            CodeEditorField::new('dataJson')
                           ->setDisabled(true)
                           ->hideOnIndex()
                           ->setLanguage('js')
                           ->setLabel('JSON'),
            DateTimeField::new('createdAt')->setDisabled()->setLabel('Created at'),
        ];
    }
}
