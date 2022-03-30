<?php

namespace App\Form;

use App\Entity\Jeu;
use App\Entity\Editeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class Jeu1Type extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('nom')
            ->add('anneeSortie', NumberType::class)
            ->add('prixSortie', NumberType::class)
            ->add('editeur', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'nom'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
        ]);
    }
}
