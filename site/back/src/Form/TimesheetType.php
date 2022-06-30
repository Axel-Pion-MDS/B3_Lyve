<?php

namespace App\Form;

use App\Entity\Timesheet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimesheetType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['invalid_message' => 'The title value is invalid'])
            ->add('startDate', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:i:s',
                'html5' => false,
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:i:s',
                'html5' => false,
            ])
            ->add('comment', TextType::class, ['invalid_message' => 'The comment value is invalid'])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'multiple' => true,
                'expanded' => true,
                'invalid_message' => 'the user value is invalid'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Timesheet::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
