<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserRegisterType extends AbstractType
{
  private $translator;
  public function __construct(TranslatorInterface $translator)
  {
    $this->translator = $translator;
  }
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('email', EmailType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'required' => TRUE,
        'label' => $this->translator->trans('Email address'),
        'label_attr' => [
          'class' => 'form-label'
        ],
      ])
      ->add('plainPassword', RepeatedType::class, [
        'type' => PasswordType::class,
        'first_options' =>  [
          'attr' => [
            'class' => 'form-control'
          ],
          'label' => $this->translator->trans('Password'),
          'required' => TRUE,
        ],
        'second_options' => [
          'attr' => [
            'class' => 'form-control'
          ],
          'label' => $this->translator->trans('Confirm password'),
          'required' => TRUE,
        ],
        'invalid_message' => $this->translator->trans('Passwords are not identical'),
      ])
      ->add('firstname', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => $this->translator->trans('Firstname'),
        'label_attr' => [],
        'required' => TRUE,
      ])
      ->add('lastname', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => $this->translator->trans('Lastname'),
        'label_attr' => [],
        'required' => TRUE,
      ])
      ->add('nickname', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => $this->translator->trans('Pseudo (optional)'),
        'label_attr' => [
          'class' => 'form_label'
        ]
      ])

      ->add('submit', SubmitType::class, [
        'attr' => [
          'class' => 'btn btn-primary'
        ]
      ]);;
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
