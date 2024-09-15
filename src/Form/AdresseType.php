<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $adressesClient = $options['adressesClient']; // Les adresses passées comme option
        if (count($adressesClient) > 0) {
            $choices = [];

            // Utiliser un foreach pour construire les choix
            foreach ($adressesClient as $index => $adresse) {
                $formattedAdresse = sprintf(
                    '%s, %s, %s, %s',
                    $adresse['libelle_voie'],
                    $adresse['code_postal'],
                    $adresse['ville'],
                    $adresse['pays']
                );
                $choices[$formattedAdresse] = $index; // Index utilisé comme clé
            }
            // Ajouter un choix parmi les adresses existantes
            $builder->add('adresse_existante', ChoiceType::class, [
                'choices' => $choices, // Les choix générés par le foreach
                'label' => 'Choisissez une adresse existante',
                'mapped' => false, // Ce champ ne sera pas mappé dans l'entité
                'required' => false,
                'placeholder' => 'Aucune adresse sélectionné',
                'attr' => [
                    'id' => 'adresse_existante', // ID pour JavaScript
                ],
            ]);
        }
        // Ajouter les champs pour la nouvelle adresse
        $builder
            ->add('id_adresse', HiddenType::class, [
                'required' => false,
                'mapped' => false, // Ce champ n'est pas directement mappé à l'entité
                'attr' => ['id' => 'id_adresse'],
            ])
            ->add('libelle_voie', TextType::class, [
                'label' => 'Nouvelle Adresse',
                'required' => false,
                'constraints' => [new NotBlank(['groups' => ['new_address']])], // Contraint dans un groupe
                'data' => '',
                'attr' => ['id' => 'libelle_voie'],
            ])
            ->add('type_adresse', ChoiceType::class, [
                'required' => false,
                'label' => 'Type d\' adresse',
                'choices' => [
                    'Livraison' => 'livraison',
                    'Facturation' => 'facturation',
                    'Livraison et Facturation' => 'Livraison et Facturation',

                ],
                'constraints' => [new NotBlank(['groups' => ['new_address']])],
                'attr' => ['id' => 'type_adresse'],
            ])
            ->add('code_postal', TextType::class, [
                'required' => false,
                'label' => 'Code Postal',
                'constraints' => [new NotBlank(['groups' => ['new_address']])],
                'attr' => ['id' => 'ville'],
            ])
            ->add('ville', TextType::class, [
                'required' => false,
                'label' => 'Ville',
                'constraints' => [new NotBlank(['groups' => ['new_address']])],
                'attr' => ['id' => 'ville'],
            ])

            ->add('pays', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Albanie' => 'Albanie',
                    'Allemagne' => 'Allemagne',
                    'Andorre' => 'Andorre',
                    'Arménie' => 'Arménie',
                    'Autriche' => 'Autriche',
                    'Azerbaïdjan' => 'Azerbaïdjan',
                    'Belgique' => 'Belgique',
                    'Biélorussie' => 'Biélorussie',
                    'Bosnie-Herzégovine' => 'Bosnie-Herzégovine',
                    'Bulgarie' => 'Bulgarie',
                    'Chypre' => 'Chypre',
                    'Croatie' => 'Croatie',
                    'Danemark' => 'Danemark',
                    'Espagne' => 'Espagne',
                    'Estonie' => 'Estonie',
                    'Finlande' => 'Finlande',
                    'France' => 'France',
                    'Géorgie' => 'Géorgie',
                    'Grèce' => 'Grèce',
                    'Hongrie' => 'Hongrie',
                    'Islande' => 'Islande',
                    'Irlande' => 'Irlande',
                    'Italie' => 'Italie',
                    'Kazakhstan' => 'Kazakhstan',
                    'Kosovo' => 'Kosovo',
                    'Lettonie' => 'Lettonie',
                    'Liechtenstein' => 'Liechtenstein',
                    'Lituanie' => 'Lituanie',
                    'Luxembourg' => 'Luxembourg',
                    'Malte' => 'Malte',
                    'Moldavie' => 'Moldavie',
                    'Monaco' => 'Monaco',
                    'Monténégro' => 'Monténégro',
                    'Norvège' => 'Norvège',
                    'Pays-Bas' => 'Pays-Bas',
                    'Pologne' => 'Pologne',
                    'Portugal' => 'Portugal',
                    'République Tchèque' => 'République Tchèque',
                    'Macédoine du Nord' => 'Macédoine du Nord',
                    'Roumanie' => 'Roumanie',
                    'Royaume-Uni' => 'Royaume-Uni',
                    'Russie' => 'Russie',
                    'Saint-Marin' => 'Saint-Marin',
                    'Serbie' => 'Serbie',
                    'Slovaquie' => 'Slovaquie',
                    'Slovénie' => 'Slovénie',
                    'Suède' => 'Suède',
                    'Suisse' => 'Suisse',
                    'Ukraine' => 'Ukraine',
                    'Vatican' => 'Vatican',
                ],
                'label' => 'Pays',
                'constraints' => [new NotBlank(['groups' => ['new_address']])],
                'attr' => ['id' => 'pays'],
            ]);

        // Ajout d'un Event Listener pour gérer la soumission du formulaire
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($adressesClient) {
            $data = $event->getData(); // Les données soumises
            $form = $event->getForm();

            // Vérifier si l'utilisateur a sélectionné une adresse existante
            if (isset($data['adresse_existante']) && $data['adresse_existante'] !== "") {
                $selectedIndex = $data['adresse_existante'];
                // Si une adresse existante est sélectionnée, on remplace les données par cette adresse
                if (isset($adressesClient[$selectedIndex])) {
                    $selectedAdresse = $adressesClient[$selectedIndex];
                    $data['libelle_voie'] = $selectedAdresse['libelle_voie'];
                    $data['code_postal'] = $selectedAdresse['code_postal'];
                    $data['ville'] = $selectedAdresse['ville'];
                    $data['pays'] = $selectedAdresse['pays'];
                }

                // Effacer les champs de la nouvelle adresse si une adresse existante est sélectionnée
                $data['libelle_voie'] = $selectedAdresse['libelle_voie'];
                $data['code_postal'] = $selectedAdresse['code_postal'];
                $data['ville'] = $selectedAdresse['ville'];
                $data['pays'] = $selectedAdresse['pays'];
                // Mettre à jour les données
                $data['id_adresse'] = $adressesClient[$selectedIndex]['id'];
                $event->setData($data);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
            'adressesClient' => [], // Option par défaut, vide si aucune adresse
        ]);
    }
}
