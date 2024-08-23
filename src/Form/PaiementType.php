<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_carte', TextType::class, [
                'label' => 'Nom sur la carte',
                'constraints' => [new NotBlank()],
            ])
            ->add('numero_carte', TextType::class, [
                'label' => 'Numéro de la carte',
                'constraints' => [new NotBlank()],
            ])
            ->add('date_expiration_carte', TextType::class, [
                'label' => 'Date d\'expiration (MM/AA)',
                'constraints' => [new NotBlank()],
            ])
            ->add('CVV', PasswordType::class, [
                'label' => 'CVV',
                'constraints' => [new NotBlank()],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        
        ]);
    }
}

