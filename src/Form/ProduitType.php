<?php

namespace App\Form;

use App\Entity\Categorie;
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
        $builder
            ->add('nom_prod', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
                ])
            ->add('description_prod',TextareaType::class,[
                'label' => 'Description du produit',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
                ])
            ->add('prix_prod', NumberType::class, [
                'label' => 'prix du produit',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200',
                'step' => '0.01', // Permet les nombres avec des décimales
                'min' => '9.99', 
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
                'attr' => [
                    'class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200',
                    'style' => 'margin-top:0;',
                    ]
            ])
            ->add('disponibilite', CheckboxType::class,[
                'label' => 'Disponible ?',
                'required' => false,
                'label_attr' => ['class' => 'inline-block mr-2'],
                'attr' => ['class' => 'mt-1 inline-block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
            ])
            ->add('highlander', CheckboxType::class,[
                'label' => 'Highlander ?',
                'required' => false,
                'label_attr' => ['class' => 'inline-block mr-2'],
                'attr' => ['class' => 'mt-1 inline-block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
            ])
            ->add('ordre', NumberType::class, [
                'label' => 'N° d\'ordre',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => function (Categorie $categorie) {
                    return $categorie->getId() . ' - ' . $categorie->getNomCat();
                },
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => ['class' => 'w-full text-white bg-orange-400 text-white py-2 rounded-md hover:bg-orange-600 focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']
            ]);


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
