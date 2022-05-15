<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Offer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['invalid_message' => 'The title value is invalid'])
            ->add('price', NumberType::class, [
                'grouping' => true,
                'scale' => 2,
                'invalid_message' => 'the price value is invalid'
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
            'data_class' => Offer::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
