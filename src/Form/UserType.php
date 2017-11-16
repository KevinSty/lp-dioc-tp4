<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\{TextType, BirthdayType, SubmitType};

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // FIXME: Ajouter les champs firstname, lastname, email, birthday

        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', TextType::class)
            ->add('plainPassword', RepeatedType::class, [
                'mapped'         => false,
                'type'           => PasswordType::class,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('birthday', BirthdayType::class)
            ->add('save', SubmitType::class, array('label' => 'Register'))
            ->getForm();

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // FIXME: ajouter la configuration du form
        $resolver->setDefaults(array('data_class' => User::class));
    }
}
