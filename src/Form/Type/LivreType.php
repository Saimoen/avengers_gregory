<?php

namespace App\Form\Type;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre du livre'
            ])
            // ->add('auteurs', EntityType::class, [
            //     'class' => Auteur::class,
            //     'multiple' => true,
            //     'label' => 'Auteur(s) du livre',
            // ])
            ->add('auteur_id', EntityType::class, [
                'class' => Auteur::class,
                'label' => 'Auteur du livre',
                'multiple' => false,
            ])
            ->add('annee', IntegerType::class, [
                'label' => 'Année de parution'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
