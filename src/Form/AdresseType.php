<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Quel nom souhaiter donner à votre adresse',
                'attr'=>[
                    'placeholder'=>'Nommez votre adresse'
                ]
                ])
            ->add('firstname', TextType::class, [
                'label'=>'Prénom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre prénom'
                ]
                ])
            ->add('lastname', TextType::class, [
                'label'=>'Nom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre nom'
                ]
                ])
            ->add('company', TextType::class, [
                'label'=>'Votre société',
                'attr'=>[
                    'placeholder'=>'(facultatif) Merci de saisir votre société'
                ]
                ])
            ->add('adresse', TextType::class, [
                'label'=>'Votre adresse',
                'attr'=>[
                    'placeholder'=>'73 rue Gutenberg....'
                ]
                ])
            ->add('postal', TextType::class, [
                'label'=>'Votre code postal',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre code postal'
                ]
                ])
            ->add('city', TextType::class, [
                'label'=>'Votre ville',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre ville'
                ]
                ])
            ->add('country', CountryType::class, [
                'label'=>'Pays',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre Pays'
                ]
                ])
            ->add('phone', TelType::class, [
                'label'=>'Votre teléphone',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre Numéro de téléphone'
                ]
                ])
            ->add('submit', SubmitType::class,[
                'label'=>"Ajouter mon adresse",
                'attr'=>[
                    'class'=>'btn-block btn-info'
                ] 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
