<?php

namespace App\Form\Type;

use App\Entity\Adresse;
use App\Entity\Auteur;
use App\Entity\MarquePage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarquePageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class, [
                'label' => 'URL du marque page'
            ])
            ->add('commentaire', TextType::class, [
                'label' => 'Commentaire du marque page'
            ])
            // ->add('motcles', TextType::class, [
            //     'label' => 'Mots clés du marque page'
            // ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MarquePage::class,
        ]);
    }
}
