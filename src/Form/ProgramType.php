<?php

namespace App\Form;

use App\Entity\Band;
use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('journey_of_reservation', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('name', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('description', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('created_at', DateType::class,[
                'attr' => [
                    'class' => 'form-control'
                 ]  
            ])

            ->add('band', EntityType::class,[
                 'class' => Band::class,
                //  'attr' => [
                //     'class' => 'form-control'
                //  ]
                 ])

        //     ->add('user', EntityType::class,[
        //          'type' => User::class,
        //          'attr' => [
        //             'class' => 'form-control'
        //         ]
        //    ])

            ->add('submit', SubmitType::class,[
                 'attr' => [
                    'class' => 'btn btn-primary'
                 ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
            
        ]);
    }
}
