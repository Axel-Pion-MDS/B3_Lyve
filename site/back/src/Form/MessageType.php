<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\Message;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, ['invalid_message' => 'The content value is invalid'])
            ->add('created_at', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:i',
                'html5' => false,
            ])
            ->add('updated_at', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:i',
                'html5' => false,
            ])
            ->add('user', EntityType::class, ['class' => User::class, 'invalid_message' => 'The user value is invalid'])
            ->add('answer', EntityType::class, ['class' => Answer::class, 'invalid_message' => 'The answer value is invalid'])
            ->add('messages', EntityType::class, ['class' => Message::class, 'invalid_message' => 'The message value is invalid'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
