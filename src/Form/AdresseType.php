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

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('libelle_voie', TextType::class, [
            'label' => 'Adresse',
            'constraints' => [new NotBlank()]
        ])
        ->add('code_postal', TextType::class, [
            'label' => 'Code Postal',
            'constraints' => [new NotBlank()]
        ])
        ->add('ville', TextType::class, [
            'label' => 'Ville',
            'constraints' => [new NotBlank()]
        ])
        /*->add('type_adresse', TextType::class, [ 
            'label' => 'Type d\'adresse',
            'required' => false
        ])*/
        ->add('pays', ChoiceType::class, [
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
            'constraints' => [new NotBlank()]
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Continuer au paiement'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
