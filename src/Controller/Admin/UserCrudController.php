<?php

namespace App\Controller\Admin;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class UserCrudController extends AbstractCrudController
{

  public static function getEntityFqcn(): string
  {
    return User::class;
  }

  public function configureCrud(Crud $crud): Crud
  {
    return $crud
        ->setEntityLabelInPlural("Utilisateurs")
        ->setEntityLabelInSingular("Utilisateur")
        ->setPageTitle("index", "Administration des utilisateurs");

  }

  public function configureFields(string $pageName): iterable
  {
    return [
        IdField::new('id')
            ->hideOnForm(), 
        EmailField::new('email')
            ->setFormTypeOption('disabled', 'disabled'), 
        TextField::new('lastname'),
        TextField::new('firstname'),
        TextField::new('nickname'),
        ArrayField::new('roles')
            ->hideOnIndex()
    ];
  }
}

