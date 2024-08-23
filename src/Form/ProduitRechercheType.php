<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Ici, on utilise les noms des catégories au lieu des ID
        $categories = [];
        foreach ($options['categories'] as $categorie) {
            $categories[$categorie->getNomCat()] = $categorie->getId();
        }
        
        $builder
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Nom du produit'
            ])
            ->add('description', TextType::class, [
                'required' => false,
                'label' => 'Description'
            ])
            ->add('materiaux', TextType::class, [
                'required' => false,
                'label' => 'Matériaux'
            ])
            ->add('prixMin', NumberType::class, [
                'required' => false,
                'label' => 'Prix minimum'
            ])
            ->add('prixMax', NumberType::class, [
                'required' => false,
                'label' => 'Prix maximum'
            ])
            ->add('categories', ChoiceType::class, [
                'choices' => $categories,
                'required' => false,
                'multiple' => false, // menu déroulant
                'expanded' => false, // false pour un menu déroulant
                'label' => 'Catégories'
            ])
            ->add('inStock', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                ],
                'required' => false,
                'expanded' => false, // Menu déroulant
                'label' => 'En stock'
            ])
            ->add('sort', ChoiceType::class, [
                'choices' => [
                    'Prix croissant' => 'price_asc',
                    'Prix décroissant' => 'price_desc',
                    'En stock' => 'in_stock'
                ],
                'required' => false,
                'label' => 'Trier par'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'categories' => [], // Par défaut, aucune catégorie n'est définie
        ]);
    }
}
