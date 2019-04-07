<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\LineUp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


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
             ->add('lineUp', EntityType::class, [
                 'class' => LineUp::class,
                 'required' => false,
                 'choice_label' => 'name',
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
