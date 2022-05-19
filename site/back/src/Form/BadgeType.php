<?php

namespace App\Form;

use App\Entity\Badge;
use App\Entity\Module;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BadgeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['invalid_message' => 'The title value is invalid'])
            ->add('picture', TextType::class, ['invalid_message' => 'The picture value is invalid'])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'invalid_message' => 'The title value is invalid'
            ])
            ->add('modules', EntityType::class, [
                'class' => Module::class,
                'multiple' => true,
                'expanded' => true,
                'invalid_message' => 'The module value is invalid'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Badge::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
