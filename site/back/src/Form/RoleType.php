<?php

namespace App\Form;

use App\Entity\Role;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['invalid_message' => 'The title value is invalid'])
            ->add('created_at', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:i',
                'html5' => false,
                'invalid_message' => 'The updatedAt date value is invalid'
            ])
            ->add('updated_at', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:i',
                'html5' => false,
                'invalid_message' => 'The updatedAt date value is invalid'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Role::class,
        ]);
    }
}
