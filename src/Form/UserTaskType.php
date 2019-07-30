<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use App\Entity\UserTask;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTask', EntityType::class, [
                'class' => Task::class,
                'required' => false,
                'choice_label' => 'title',
            ])
            ->add('idUser', EntityType::class, [
                'class' => User::class,
                'required' => false,
                'choice_label' => 'firstName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserTask::class,
        ]);
    }
}
