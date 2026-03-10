<?php

namespace App\Modules\Conference\Presentation\AdminHttp\Form;


use App\Modules\Conference\Domain\Entity\DTO\ConferenceProgramDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ConferenceProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'fromTime',
                TimeType::class,
                [
                    'required' => false,
                    'label'    => 'Время с',
                    'widget'   => 'single_text',
                ]
            )
            ->add(
                'tillTime',
                TimeType::class,
                [
                    'required' => false,
                    'label'    => 'по',
                    'widget'   => 'single_text',
                ]
            )
            ->add(
                'subject',
                TextType::class,
                [
                    'required' => false,
                    'label'    => 'Тема',
                ]
            )
            ->add(
                'lecturers',
                TextType::class,
                [
                    'required' => false,
                    'label'    => 'Лекторы',
                ]
            );
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ConferenceProgramDto::class,
        ]);
    }
}