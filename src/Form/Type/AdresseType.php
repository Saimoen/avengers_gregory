<?php

namespace App\Form\Type;

use App\Entity\Adresse;
use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rue', TextType::class, [
                'label' => 'Rue de l\'adresse'
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code postal de l\'adresse'
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville de l\'adresse'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
