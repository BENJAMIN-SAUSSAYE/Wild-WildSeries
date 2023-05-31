<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Program;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ActorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom',
                    'attr' => [
                        'placeholder' => 'Nom de l\'acteur...',
                    ],
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            )
            ->add(
                'programs',
                EntityType::class,
                [
                    'class' => Program::class,
                    'choice_label' => 'title',
                    'multiple' => true,
                    'expanded' => false,
                    'by_reference' => false,
                ]
            )
            ->add(
                'actorImageFile',
                VichFileType::class,
                [
                    'label'         => 'Image',
                    'required'      => false,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_uri' => true, // not mandatory, default is true
                    'row_attr' => [
                        'class' => 'form-row-split my-1 py-2', /* 'input-group' 'form-row-split' 'form-floating' */
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actor::class,
        ]);
    }
}
