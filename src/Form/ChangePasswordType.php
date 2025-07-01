<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',  EmailType::class, [
                'disabled'=>true,
                'label'=>'Email'
            ])
            ->add('firstname', TextType::class, [
                'disabled'=>true,
                'label'=>'Prénom',
            ])
            ->add('Lastname', TextType::class, [
                'disabled'=>true,
                'label'=>'Nom',
            ])
        
            ->add('old_password', PasswordType::class, [
                'label'=>'Mot de passe actuel',
                'mapped'=>false,
                'attr'=> [
                    'placeholder'=>'Votre mot de passe actuel'
                ]
            ])
            ->add('new_Password',RepeatedType::class,[
                'type' => PasswordType::class,
                'label'=>'Nouveau mot de passe ',
                'mapped'=>false,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe',
                'attr'=>[
                    'placeholder'=>'Choisissez votre nouveau mot de passe'
                ]  
            ],
                'second_options' => ['label' => 'Confirmer votre nouveau mot de passe ',
                'attr'=>[
                    'placeholder'=>'Confirmez votre mot de passe',
                    
                ]
            ],

        ])
        ->add('submit', SubmitType::class,[
            'label'=>"Sauvgarder"  
        ]);

           
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
