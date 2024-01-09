<?php

namespace App\Form;

use App\Entity\Band;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class BandType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ]
      ])

      ->add('musicalStyle', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ]
      ])

      ->add('picture', FileType::class, [
        'mapped' => false,
        // 'required' => false
      ])



      ->add('description', TextType::class, [
        'attr' => [
          'class' => 'form-control',

        ]
      ])



      ->add('submit', SubmitType::class, [
        'attr' => [
          'class' => 'btn btn-primary'
        ]
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Band::class,

    ]);
  }
}
