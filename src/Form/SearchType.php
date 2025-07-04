<?php

namespace App\Form;

use App\Classe\Search;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // Add this line




class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('string', TextType::class, [
        'label'=>false,
        'required'=>false,
        'attr'=>[
            'placeholder'=>'Votre recherche'
        ]
        ])
        ->add('categories', EntityType::class, [
            'label'=>false,
            'required'=>false,
            'class'=> Categorie::class,
            'multiple'=>true,
            'expanded'=>true,
                
        ])
        ->add('submit', SubmitType::class,[
            'label'=>'Filtrer',
            'attr'=>[
                'class'=>'btn-block btn-info'
            ]
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method'=>'GET',
            'crsf_protection'=>false,
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }

}