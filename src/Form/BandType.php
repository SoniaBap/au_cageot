<?php

namespace App\Form;

use App\Entity\Band;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
                ])

            ->add('musical_style', TextType::class, [
                'attr' => [
                   'class' => 'form-control'
                ]
            ])

            ->add('picture', VichType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('programs', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('user', EntityType::class, [
                'class' => User::class,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Band::class,
        ]);
    }
}
