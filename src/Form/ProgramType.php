<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Titre',
                    'attr' => [
                        'placeholder' => 'Titre de la série..',
                    ],
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            )
            ->add(
                'synopsis',
                TextareaType::class,
                [
                    'label' => 'Synopsys',
                    'attr' => [
                        'placeholder' => 'Synopsis de la série..',
                        'style' => 'height:20vh'
                    ],
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            )
            ->add(
                'poster',
                UrlType::class,
                [
                    'label' => 'Image URL',
                    'data' => 'https://fakeimg.pl/250x300/?text=SERIE TV&font_size=62&font=bebas',
                    'attr' => [
                        'placeholder' => 'Url d\'une image...',
                    ],
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'label' => 'Catégorie',
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'attr' => [
                        'class' => 'form-select-lg mb-3',
                    ],
                    // used to render a select box, check boxes or radios
                    // 'multiple' => true,
                    // 'expanded' => true,
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ],
            )
            ->add(
                'actors',
                EntityType::class,
                [
                    'class' => Actor::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => false,
                ]
                // ->add('Enregistrer', SubmitType::class, [
                //     'label' => 'Enregistrer',
                //     'attr' => [
                //         'class' => 'btn btn-sm text-nowrap btn-primary m-2 px-2',
                //     ],
                //     'row_attr' => [
                //         'class' => 'form-row-split px-5', /* 'input-group' 'form-row-split' 'form-floating' */
                //     ],
                // ])
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
            'validation_groups' => ['programValidation']
        ]);
    }
}
