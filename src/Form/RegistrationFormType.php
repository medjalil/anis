<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username')
                ->add('email')
                ->add('password', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'constraints' => [
                        new NotBlank(),
                        new Length([
                            'min' => 8,
                            'max' => 128,
                                ]),
                    ],
                    'first_options' => [
                        'label' => 'Nouveau mot de passe',
                        'attr' => array('placeholder' => 'Nouveau mot de passe')
                    ],
                    'second_options' => [
                        'label' => 'Confirmer le mot de passe',
                        'attr' => array('placeholder' => 'Confirmer le mot de passe')
                    ],
                ])
                ->add('roles', ChoiceType::class, [
                    'choices' => [
                        'Docteur' => 'ROLE_DR',
                        'Patient' => 'ROLE_PT',
                    ],
                    'expanded' => true,
                    'multiple' => false,
                    'mapped' => false,
                    'label' => 'Vous êtes',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}
