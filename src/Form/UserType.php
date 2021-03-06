<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            // ->add('roles')
            // ->add('password')
            // ->add('username')
            ->add('nom')
            ->add('prenom')
            ->add('poste')
            ->add('description')
            ->add('photoprofil', FileType::class, [
                'mapped' => false,
                'required' => false
            ])
            ->add('photobandeau', FileType::class, [
                'mapped' => false,
                'required' => false
            ])
            ->add('facebook')
            ->add('instagram')
            ->add('twitter')
            ->add('linkedin')
            ->add('chocolaterie');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,

        ]);
    }
}
