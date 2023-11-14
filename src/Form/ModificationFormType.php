<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ModificationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder



            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'attr' =>['class'=>'form-control']

            ])
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'attr' =>['class'=>'form-control']

            ])
            ->add('cin', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'attr' =>['class'=>'form-control']

            ])
            ->add('region', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'attr' =>['class'=>'form-control']

            ])
            ->add('ville', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'attr' =>['class'=>'form-control']

            ])
            ->add('adresse', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'attr' =>['class'=>'form-control']

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
