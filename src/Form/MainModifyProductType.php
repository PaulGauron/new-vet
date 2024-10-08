<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MainModifyProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $produit = $options['data'][0];
        $isEdit = true;

        $builder
            ->add('images' , ImagesType::class,['is_edit' => $isEdit])
            ->add('produit', ProduitType::class, ['data' => $produit]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data' => ['produit' => null, 'images' => null],
            'data_class' => null, // Par défaut, pas de classe de données associée
            'is_edit' => true, // Définissez l'option par défaut
        ]);
    }
}
