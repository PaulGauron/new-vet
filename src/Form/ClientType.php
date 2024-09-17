<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'nom_carte',
                TextType::class,
                [
                    'label' => 'Nom de la carte',
                    'label_attr' => ['class' => 'block text-gray-700 font-bold mb-2'],
                ]

            )
            ->add('telephone', NumberType::class, [
                'label' => 'Téléphone',
                'label_attr' => ['class' => 'block text-gray-700 font-bold mb-2'],
            ])
            ->add('methode_paiement', ChoiceType::class, [
                'label' => 'Methode de paiement',
                'label_attr' => ['class' => 'block text-gray-700 font-bold mb-2'],
                'choices' => [
                    'Visa' => 'visa',
                    'MasterCard' => 'mastercard',
                ],
                'expanded' => false, // Si vous voulez un dropdown (déroulant), laissez à false
                'multiple' => false, // Choix unique, donc false
                'placeholder' => 'Sélectionnez une méthode', // Optionnel: pour ajouter un choix par défaut vide
            ])
            ->add('numero_carte', NumberType::class, [
                'label' => 'numéros de carte',
                'label_attr' => ['class' => 'block text-gray-700 font-bold mb-2'],
            ])
            ->add('date_expiration_carte', DateType::class, [
                'label' => 'Date d\'expiration de la carte',
                'label_attr' => ['class' => 'block text-gray-700 font-bold mb-2'],
                'widget' => 'choice', // Choix par défaut, permet de choisir séparément le mois et l'année
                'format' => 'd/MM/yyyy', // Format d'affichage
                'years' => range(date('Y'), date('Y') + 20), // Limite les années disponibles
                'months' => range(1, 12), // Limite les mois de 1 à 12
                'days' => [1], // Désactive le choix du jour
            ])
            ->add('CVV', NumberType::class, [
                'label' => 'CVV',
                'label_attr' => ['class' => 'block text-gray-700 font-bold mb-2'],
                'attr' => [
                    'maxlength' => 3,  // Limite le nombre de caractères au niveau HTML
                ],
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\Length([
                        'max' => 3,
                        'maxMessage' => 'Le CVV doit contenir exactement {{ limit }} chiffres.',
                    ]),
                    new \Symfony\Component\Validator\Constraints\Positive(), // Assure que le CVV est un nombre positif
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
