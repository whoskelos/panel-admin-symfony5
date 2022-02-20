<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig\FilterConfig;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions):actions{
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->update(Crud::PAGE_INDEX,Action::NEW,function(Action $action){
            return $action->setIcon('fa fa-user')->addCssClass('btn btn-success');
        })
            ->update(Crud::PAGE_INDEX,Action::EDIT,function(Action $action){
                return $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning');
            })
                ->update(Crud::PAGE_INDEX,Action::DETAIL,function(Action $action){
                    return $action->setIcon('fa fa-eye')->addCssClass('btn btn-info');
                })
                    ->update(Crud::PAGE_INDEX,Action::DELETE,function(Action $action){
                        return $action->setIcon('fa fa-bin')->addCssClass('btn btn-outline-danger');
                    });
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id') ->hideOnForm(),
            TextField::new('apellidos'),
            EmailField::new('email'),
            TextField::new('password')->hideOnIndex(),
            TextEditorField::new('descripcion'),
            ImageField::new('image')
            ->setBasePath('images/user')
            ->setUploadDir('public/images/user')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('Apellidos');
    }
}
