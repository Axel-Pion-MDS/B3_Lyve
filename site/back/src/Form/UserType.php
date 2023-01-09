<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\Badge;
use App\Entity\Offer;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ['invalid_message' => 'The firstname value is invalid'])
            ->add('lastname', TextType::class, ['invalid_message' => 'The lastname value is invalid'])
            ->add('email', EmailType::class, ['invalid_message' => 'The email value is invalid'])
            ->add('password', PasswordType::class, ['invalid_message' => 'The password value is invalid'])
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => false,
            ])
            ->add('number', TextType::class, ['invalid_message' => 'The number value is invalid'])
            ->add('badges', EntityType::class, [
                'class' => Badge::class,
                'multiple' => true,
                'expanded' => true,
                'invalid_message' => 'The badge value is invalid'
            ])
            ->add('offer', EntityType::class, ['class' => Offer::class, 'invalid_message' => 'The offer value is invalid'])
//            ->add('role', EntityType::class, ['class' => Role::class, 'invalid_message' => 'The role value is invalid'])
            ->add('answers', EntityType::class, [
                'class' => Answer::class,
                'multiple' => true,
                'expanded' => true,
                'invalid_message' => 'The badge value is invalid'
            ])
            ->add('isFirstConnection', CheckboxType::class, [
                'value' => 1,
                'required' => false,
                'invalid_message' => 'The first connection value is invalid'
            ])
            ->add('isPasswordChanged', CheckboxType::class, [
                'value' => 0,
                'required' => false,
                'invalid_message' => 'The password change value is invalid'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
