<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                null,
                [
                    'label' => 'Numéro De Saison',
                    'attr' => [
                        'placeholder' => 'Numéro de la saison...',
                    ],
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            )
            ->add(
                'year',
                null,
                [
                    'label' => 'Année',
                    'attr' => [
                        'placeholder' => 'Date de la saison...',
                    ],
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
                    ],
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
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
                        'placeholder' => 'select...',
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
