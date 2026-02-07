<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Block::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('page', 'Страница')
                ->setRequired(true),
            TextField::new('title'),
            TextField::new('slug')->hideOnIndex()->setRequired(false),
            TextField::new('description'),
            BooleanField::new('isActive'),

            CollectionField::new('posts')
                ->useEntryCrudForm(PostCrudController::class)
                ->allowAdd()
                ->allowDelete()
                ->setSortable(true),
        ];
    }

}
