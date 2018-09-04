<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/4/2018
 * Time: 12:28 PM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangeDueDateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dueDate', DateTimeType::class, [
                'label' => 'Change due date to'
            ])
            ->add(
                'changeDueDateReason',
                TextareaType::class,
                [
                    'label' => 'Please provide the reason of due date changing',
                    'required' => false
                ]
            )
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => ['update-due-date']
        ]);
    }
}