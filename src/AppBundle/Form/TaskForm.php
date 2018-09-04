<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/3/2018
 * Time: 3:37 PM
 */

namespace AppBundle\Form;

use AppBundle\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskForm extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Post title',
                'required' => false
            ])
            ->add('slug', TextType::class, [
                'label' => 'Post slug'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Post content'
            ])
            ->add('dueDate', DateTimeType::class, [
                'label' => 'Due Date'
            ])
            ->add('agreement', CheckboxType::class, [
                'label' => 'I agree',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank(
                        [
                            'message' => 'You must apply the terms'
                        ]
                    )
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Submit',
            ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getBlockPrefix()
    {
        return '';
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Task::class,
            'csrf_protection' => false,
        ));
    }
}