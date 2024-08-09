<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
                ])
            ->add('prenom', TextType::class,[
                'label' => 'Prénom',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
                ])
            ->add('email', EmailType::class , [
                'label' => 'Adresse e-mail',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
                ])
            ->add('mdp', PasswordType::class , [
                'label' => 'mot de passe',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
                ])
            ->add('mdp_comfirmation' , PasswordType::class, [
                'mapped' => false, // This field is not mapped to the entity
                'label' => 'Confirmation de mot de passe',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200'],])

            ->add('telephone', NumberType::class ,[
                'label' => 'téléphone',
                'attr' => ['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200']
                ])
            ->add('inscription', SubmitType::class ,[
                'label' => 'S\'inscrire',
                'attr' => ['class' => 'w-full bg-orange-400 text-white py-2 px-4 rounded-md hover:bg-orange-400']
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
