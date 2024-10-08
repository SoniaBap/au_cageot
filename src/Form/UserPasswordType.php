<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserPasswordType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('plainPassword', PasswordType::class, [
        'attr' => [
          'class' => 'form-control'
        ],

      ])

      ->add('newPassword', RepeatedType::class, [
        'type' => PasswordType::class,
        'first_options' =>  [
          'attr' => [
            'class' => 'form-control'
          ],
          'label' => 'Mot de passe',
        ],
        'second_options' => [
          'attr' => [
            'class' => 'form-control'
          ],
          'label' => 'Confirmation du mot de passe',
        ],
        'invalid_message' => 'Les mots de passe ne sont pas identiques'
      ])

      ->add('submit', SubmitType::class, [
        'attr' =>  [
          'class' =>   'btn btn-primary'
        ]
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      // Configure your form options here
    ]);
  }
}
