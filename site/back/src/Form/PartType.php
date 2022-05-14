<?php

namespace App\Form;

use App\Entity\Part;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, ['invalid_message' => 'The content value is invalid'])
            ->add('title', TextType::class, ['invalid_message' => 'The title value is invalid'])
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Part::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
