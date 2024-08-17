<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class ConnexionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ConnectEmail', EmailType::class, [
                'label' => 'ton adresse mail',
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                ],
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']
            ])

            ->add('ConnectMdp', PasswordType::class , [
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                ],
                'attr' => ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Se Connecter',
                'attr' => ['class' => 'w-full text-white bg-orange-400 text-white py-2 rounded-md hover:bg-orange-600 focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']
            ]);
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null, // Configure your form options here
        ]);
    }
}
