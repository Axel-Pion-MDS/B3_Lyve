<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\User;
use App\Entity\UserAnswer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('created_at', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:i',
                'html5' => false,
                'invalid_message' => 'The createdAt date value is invalid'
            ])
            ->add('updated_at', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:i',
                'html5' => false,
                'invalid_message' => 'The updatedAt date value is invalid'
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'invalid_message' => 'The user value is invalid'])
            ->add('answers', EntityType::class, [
                'class' => Answer::class,
                'invalid_message' => 'The answer value is invalid'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserAnswer::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
