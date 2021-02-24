<?php

namespace App\Form;

use App\Entity\Politicien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Politicien2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('disabled' => true))
            ->add('sexe',ChoiceType::class,[
                'choices' => [
                    'Sexe' => [
                        'Homme' => 'homme',
                        'Femme' => 'femme',
                    ],
                ],
            ])
            ->add('age')
            ->add('mairie')
            ->add('parti')
            ->add('affaire',null,[
                'by_reference' => false,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Politicien::class,
        ]);
    }
}
