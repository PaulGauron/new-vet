<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class MainAddProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = $options['is_edit'] ?? false;

        $builder
            ->add('images' , ImagesType::class, [
                'is_edit' => $isEdit, // Passe l'option is_edit au sous-formulaire ImagesType
            ])
            ->add('produit', ProduitType::class, [
                'is_edit' => $isEdit, // Passe l'option is_edit au sous-formulaire ProduitType
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null, // Par défaut, pas de classe de données associée
            'is_edit' => false, // Définissez l'option par défaut
        ]);
    }
}
