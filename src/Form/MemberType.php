<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('pseudo')
            ->add('age')
            ->add('goal')
            ->add('mainGame')
            ->add('email')
            ->add('lastTeam')
            ->add('whyUs')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('discord')
            // ->add('status')
             ->add('lineUp')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
