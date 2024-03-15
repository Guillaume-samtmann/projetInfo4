<?php

namespace App\Form;

use App\Entity\DecouvrirAProximiter;
use App\Entity\DecouvrirSurPlace;
use App\Entity\MotCles;
use App\Entity\Produits;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('photo')
            ->add('photo2')
            ->add('photo3')
            ->add('photo4')
            ->add('photo5')
            ->add('photo6')
            ->add('prix')
            ->add('nbr_nuit')
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
            ])
            ->add('motsCles', EntityType::class, [
                'class' => MotCles::class,
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => true
            ])
            ->add('decouvrirSurPlace', EntityType::class, [
                'class' => DecouvrirSurPlace::class,
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => true
            ])
            ->add('decouvrirAProximiter', EntityType::class, [
                'class' => DecouvrirAProximiter::class,
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
