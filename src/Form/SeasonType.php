<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'number',
                ChoiceType::class,
                [
                    'label' => 'Numéro De Saison',
                    'choices' => range(1, 30),
                    'choice_label' => function ($value) {
                        return 'Saison n° ' . $value;
                    },
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            )
            ->add(
                'year',
                ChoiceType::class,
                [
                    'label' => 'Année De Sortie',
                    'choices' => range(Date('Y'), 1950),
                    'choice_label' => function ($value) {
                        return $value;
                    },
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Description',
                    'attr' => [
                        'placeholder' => 'Synopsis de la saison...',
                        'style' => 'height:20vh'
                    ],
                    'row_attr' => [
                        'class' => 'h-20 form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            )
            ->add(
                'program',
                EntityType::class,
                [
                    'label' => 'Série',
                    'class' => Program::class,
                    'attr' => [
                        'class' => 'form-select-lg mb-3',
                    ],
                    'choice_label' => 'title',

                    // used to render a select box, check boxes or radios
                    // 'multiple' => true,
                    // 'expanded' => true,
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ],
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }
}
