<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainCheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $client = $options['data']['client'];
        $adresse = $options['data']['adresse'];

        $builder
            ->add('client' , ClientType::class,['data' => $client])
            ->add('adresse', AdresseType::class, ['data' => $adresse]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null, // Par défaut, pas de classe de données associée
        ]);
    }
}
