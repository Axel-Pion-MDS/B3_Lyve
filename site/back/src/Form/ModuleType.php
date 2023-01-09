<?php

namespace App\Form;

use App\Entity\Badge;
use App\Entity\Module;
use App\Entity\Offer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['invalid_message' => 'The title value is invalid'])
            ->add('content', TextType::class, ['invalid_message' => 'The content value is invalid'])
            ->add('offers', EntityType::class, [
                'class' => Offer::class,
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'invalid_message' => 'The offer value is invalid'
            ])
            ->add('badges', EntityType::class, [
                'class' => Badge::class,
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'invalid_message' => 'The badge value is invalid'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
