<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\User;
use App\Entity\UserAnswer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('answer', TextType::class, ['invalid_message' => 'The title value is invalid'])
            ->add('isCorrect', ChoiceType::class, [
                'choices' => [
                    'Correct' => true,
                    'Incorrect' => false
                ],
                'expanded' => true,
                'multiple' => false,
                'invalid_message' => 'The isCorrect value is invalid'
            ])
            ->add('question', EntityType::class, ['class' => Question::class, 'invalid_message' => 'The question value is invalid'])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'multiple' => true,
                'expanded' => true,
                'invalid_message' => 'the badge value is invalid'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
