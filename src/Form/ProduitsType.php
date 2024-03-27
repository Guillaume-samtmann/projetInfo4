<?php

namespace App\Form;

use App\Entity\DecouvrirAProximiter;
use App\Entity\DecouvrirSurPlace;
use App\Entity\InformationsAnnimaux;
use App\Entity\InformationsHorraireArv;
use App\Entity\InformationsHorraireDeaprt;
use App\Entity\MotCles;
use App\Entity\Produits;
use App\Entity\Ville;
use App\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('photo', FileType::class, [
                'label' => 'PhotoPrincipale',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '200k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Sélectionnez un fichier JPEG ou PNG de poids inférieur à 200Ko',
                    ])
                ]
            ])
            ->add('photo2', FileType::class, [
                'label' => 'Photo2',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '200k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Sélectionnez un fichier JPEG ou PNG de poids inférieur à 200Ko',
                    ])
                ]
            ])
            ->add('photo3', FileType::class, [
                'label' => 'Photo3',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '200k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Sélectionnez un fichier JPEG ou PNG de poids inférieur à 200Ko',
                    ])
                ]
            ])
            ->add('photo4', FileType::class, [
                'label' => 'Photo4',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '200k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Sélectionnez un fichier JPEG ou PNG de poids inférieur à 200Ko',
                    ])
                ]
            ])
            ->add('photo5', FileType::class, [
                'label' => 'Photo5',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '200k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Sélectionnez un fichier JPEG ou PNG de poids inférieur à 200Ko',
                    ])
                ]
            ])
            ->add('photo6', FileType::class, [
                'label' => 'Photo6',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '200k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Sélectionnez un fichier JPEG ou PNG de poids inférieur à 200Ko',
                    ])
                ]
            ])
            ->add('prix')
            ->add('nbr_nuit')
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
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
            ->add('informationsHorraireArv', EntityType::class, [
                'class' => InformationsHorraireArv::class,
                'choice_label' => 'nom',
            ])
            ->add('informationsHorraireDepart', EntityType::class, [
                'class' => InformationsHorraireDeaprt::class,
                'choice_label' => 'nom',
            ])
            ->add('informationsAnnimaux', EntityType::class, [
                'class' => InformationsAnnimaux::class,
                'choice_label' => 'nom',
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
