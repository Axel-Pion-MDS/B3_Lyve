<?php

namespace App\Form;

use App\Entity\Part;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextType::class, ['invalid_message' => 'The content value is invalid'])
            ->add('part', EntityType::class, ['class' => Part::class, 'invalid_message' => 'the part value is invalid'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
