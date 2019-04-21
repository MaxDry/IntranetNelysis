<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\LineUp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                "label" => "Prénom",
                "required" => false
            ])
            ->add('pseudo', TextType::class, [
                "label" => "Pseudo",
                "required" => false
            ])
            ->add('age', IntegerType::class, [
                "label" => "Age",
                "required" => false
            ])
            ->add('goal', TextareaType::class, [
                "label" => "Objectifs",
                "required" => false
            ])
            ->add('mainGame', TextType::class, [
                "label" => "Jeu principale",
                "required" => false
            ])
            ->add('email', EmailType::class, [
                "label" => "E-mail",
                "required" => false
            ])
            ->add('lastTeam', TextType::class, [
                "label" => "",
                "required" => false
            ])
            ->add('whyUs', TextareaType::class, [
                "label" => "Vos objectifs",
                "required" => false
            ])
            ->add('discord', TextType::class, [
                "label" => "Discord",
                "required" => false
            ])
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
