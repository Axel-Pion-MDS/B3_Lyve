<?php

namespace App\Form;

use App\Entity\Chapter;
use App\Entity\Part;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('chapter', EntityType::class, ['class' => Chapter::class, 'invalid_message' => 'the chapter value is invalid'])
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
