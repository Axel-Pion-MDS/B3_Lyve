<?php

namespace App\Form;

use App\Entity\Chapter;
use App\Entity\Module;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['invalid_message' => 'The title value is invalid'])
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
            ->add('module', EntityType::class, ['class' => Module::class, 'invalid_message' => 'The module value is invalid'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapter::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
