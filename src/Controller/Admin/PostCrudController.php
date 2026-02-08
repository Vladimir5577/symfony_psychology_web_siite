<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use Symfony\Component\Validator\Constraints\Image;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            FormField::addPanel('Расположение'),
            AssociationField::new('block', 'Блок')
                ->setRequired(true),

            FormField::addPanel('Контент'),

            TextField::new('title'),
            TextareaField::new('description')->hideOnIndex(),

            ImageField::new('image')
                ->setUploadDir('public/uploads/images')
                ->setBasePath('uploads/images')
                ->setRequired(false)
                ->setFileConstraints(new Image(maxSize: '9M')),

            BooleanField::new('isActive', 'Active'),

            DateTimeField::new('createdAt')->onlyWhenUpdating()->setFormTypeOption('disabled', true),
            DateTimeField::new('updatedAt')->onlyWhenUpdating()->setFormTypeOption('disabled', true),
        ];
    }
}
