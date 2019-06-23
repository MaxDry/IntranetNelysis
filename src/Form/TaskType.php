<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                "label" => "Titre de la tâche",
                "required" => false
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description de la tâche",
                "required" => false
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'required' => false,
                'choice_label' => 'firstname',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
