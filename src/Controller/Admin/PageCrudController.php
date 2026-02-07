<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }


    public function configureFields(string $pageName): iterable
    {
//        return [
//            IdField::new('id'),
//            TextField::new('title'),
//            TextEditorField::new('description'),
//        ];

        return [
            IdField::new('id')->hideOnForm(),

            TextField::new('title'),
            TextField::new('slug'),
            IntegerField::new('position'),
            BooleanField::new('isActive'),

            CollectionField::new('blocks')
                ->useEntryCrudForm(BlockCrudController::class)
                ->allowAdd()
                ->allowDelete()
                ->setSortable(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->onlyOnForms(),
        ];
    }

}
