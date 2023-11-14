<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SendMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('subject',TextType::class,[
                'attr'=>[
                    'placeholder'=>' entre le subject de ce mail' ,
                     'class'=>'form-control',

                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your subject',
                    ]),
                ]
            ])
            ->add('message',TextareaType::class,[
                'attr'=>[
                    'placeholder'=>' ecrivez votre message avec votre clavier ou bien utiliser votre voie',
                    'class'=>'form-control',

                ],

                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your message',
                    ]),
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
