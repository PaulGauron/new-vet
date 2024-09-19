<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Materiaux;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $produit = $options['data'] ?? null;

        $builder
            ->add('nom_prod', TextType::class, [
                'label' => 'Nom du produit',
                'label_attr' => ['class'=> 'block text-gray-700 font-bold mb-2'],
                'attr' => ['class' => 'w-full p-3 border rounded-md focus:outline-none focus:ring focus:ring-orange-200'],
                'data' => $produit ? $produit->getNomProd() : ''
                ])
            ->add('description_prod',TextareaType::class,[
                'label' => 'Description du produit',
                'label_attr' => ['class'=> 'block text-gray-700 font-bold mb-2'],
                'attr' => ['class' => 'w-full p-3 border rounded-md focus:outline-none focus:ring focus:ring-orange-200'],
                'data' => $produit ? $produit->getDescriptionProd() : ''
                ])
            ->add('prix_prod', NumberType::class, [
                'label' => 'prix du produit',
                'label_attr' => ['class'=> 'block text-gray-700 font-bold mb-2'],
                'attr' => ['class' => 'w-full p-3 border rounded-md focus:outline-none focus:ring focus:ring-orange-200',
                'step' => '0.01', // Permet les nombres avec des décimales
                'min' => '9.99', 
                'data' => $produit ? $produit->getPrixProd() : 'min'
            ],
            'constraints' => [
                new Assert\NotBlank(), // Assure que le champ n'est pas vide
                new Assert\GreaterThanOrEqual(0), // Assure que la valeur est positive ou nulle
                new Assert\Type([
                    'type' => 'float',
                    'message' => 'La valeur {{ value }} n\'est pas valide',
                ]),
            ],
            ])
            ->add('stock', NumberType::class, [
                'label' => 'Stock',
                'label_attr' => ['class'=> 'block text-gray-700 font-bold mb-2'],
                'attr' => [
                    'class' => 'w-full p-3 border rounded-md focus:outline-none focus:ring focus:ring-orange-200',
                    'style' => 'margin-top:0;',
                    'data' => $produit ? $produit->getStock() : ''
                    ]
            ])
            ->add('disponibilite', CheckboxType::class,[
                'label' => 'Disponible ?',
                'label_attr' => ['class'=> 'block text-gray-700 font-bold mb-2'],
                'required' => false,
                'label_attr' => ['class' => 'inline-block mr-2'],
                'attr' => ['class' => 'w-full p-3 border rounded-md focus:outline-none focus:ring focus:ring-orange-200']
            ])
            ->add('highlander', CheckboxType::class,[
                'label' => 'Highlander ?',
                'label_attr' => ['class'=> 'block text-gray-700 font-bold mb-2'],
                'required' => false,
                'label_attr' => ['class' => 'inline-block mr-2'],
                'attr' => ['class' => 'w-full p-3 border rounded-md focus:outline-none focus:ring focus:ring-orange-200']
            ])
            ->add('ordre', NumberType::class, [
                'label' => 'N° d\'ordre',
                'label_attr' => ['class'=> 'block text-gray-700 font-bold mb-2'],
                'attr' => ['class' => 'w-full p-3 border rounded-md focus:outline-none focus:ring focus:ring-orange-200'],
                'data' => $produit ? $produit->getOrdre() : '1000'
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => function (Categorie $categorie) {
                    return $categorie->getId() . ' - ' . $categorie->getNomCat();
                },
                'data' => $produit ? $produit->getCategorie() : null, // Sélectionne la catégorie du produit si elle existe
            ])

            ->add('materiaux', EntityType::class, [
                'class' => Materiaux::class, // Entité des matériaux
                'choice_label' => function (Materiaux $materiaux) {
                    return $materiaux->getId() . ' - ' . $materiaux->getNomMat();
                },
                'multiple' => true, // Permet la sélection multiple
                'expanded' => false, // Définit si le champ est affiché en tant que case à cocher ou en tant que menu déroulant (ici, false pour menu déroulant)
                'attr' => [
                    'class' => 'w-full p-3 border rounded-md focus:outline-none focus:ring focus:ring-orange-200',
                ],
                'constraints' => [
                    new Assert\Count([
                        'max' => 3, // Limite à 3 matériaux maximum
                        'maxMessage' => 'Vous ne pouvez sélectionner que {{ limit }} matériaux au maximum.',
                    ]),
                ],
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
