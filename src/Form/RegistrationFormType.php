<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('email', EmailType::class)
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('nom', TextType::class)
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank,
                    new Length([
                        'min' => 6,
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/\d/',
                        'message' => 'Votre mot de passe doit contenir au moins un chiffre.'
                    ]),
                    new Regex([
                        'pattern' => '/[a-z]/',
                        'message' => 'Votre mot de passe doit contenir au moins une lettre minuscule.'
                    ]),
                    new Regex([
                        'pattern' => '/[A-Z]/',
                        'message' => 'Votre mot de passe doit contenir au moins une lettre majuscule.'
                    ]),
                    new Regex([
                        'pattern' => '/[!@#$%^&*]/',
                        'message' => 'Votre mot de passe doit contenir au moins un caractère spécial.'
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte les CGU',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos CGU.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
