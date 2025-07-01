<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Adresse;
use App\Entity\User;
use App\Entity\Carrier;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user=$options['user'];
        $builder

        ->add('adresse', EntityType::class, [
            'label'=>'Choisissez Votre adresse de Livraison ',
            'required'=>true,
            'class'=> Adresse::class,
            'choices' => $options['user']->getAdresses(),
            'multiple'=>false,
            'expanded'=>true,
       ])

       ->add('carrier', EntityType::class, [
        'label'=>'Choisissez Votre transporteur ',
        'required'=>true,
        'class'=> Carrier::class,
        
        'multiple'=>false,
        'expanded'=>true,
   ])

   ->add('submit', SubmitType::class, [
    'label'=>'Payer ma commande ',
    'attr'=> [
        'class'=>'btn btn-success btn-block'
    ]
]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user'=>array()
        ]);
    }
}
