<?php

namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        // null il trouve par defaut le type de champ input
            ->add('prenom', null,[
                'label' => 'Votre prénom',
                'attr' => ['class'=>'toto', 'placeholder'=>'Saisissez votre prénom']
            ])
            ->add('nom', null,[
                'label' => 'Votre nom',
                'attr' => ['class'=>'toto', 'placeholder'=>'Saisissez votre nom']
            ])
            //->add('age')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // ici je relie le formulaire à l'ENTITY
            'data_class' => Personne::class,
        ]);
    }
}
