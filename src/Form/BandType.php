<?php

namespace App\Form;

use App\Entity\Band;
use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

            ->add('musicalStyle', TextType::class, [
                'attr' => [
                   'class' => 'form-control'
                ]
            ])

            ->add('pictureFile', VichImageType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'require' => false,
                    'allow_delete' => true, //// not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                ]
            ])

            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            // ->add('program', EntityType::class, [
            //     'class' => Program::class,
            //     'attr' => [
            //         'class' => 'form-control',
            //         'expanded' => true,
            //         'multiple' => true,
            //     ]
            // ])

           // ->add('updated_at', DateTime)

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
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
