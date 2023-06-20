<?php

namespace App\Form;

use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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

            ->add('journey_of_reservation', Textype::class,[
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

            ->add('program', TextType::class,[
                 'attr' => [
                    'class' => 'form-control'
                 ]
            ])

            ->add('submit', Submit::class,[
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
