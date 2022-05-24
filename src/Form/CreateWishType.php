<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateWishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom du souhait',
                'attr' => [
                    'placeholder' => 'Votre souhait...'
                ],
                'required' => false
            ])

            ->add('description', TextareaType::class, [
                'label' => 'Description du souhait',

                'attr' => [
                        'class' => "descText"
                    ]
                ])

            ->add('author', TextType::class, [
                'label' => 'Auteur du souhait',
                'attr' => [
                    'placeholder' => 'Michel'
                ],
                'required' => false
            ])
/*            ->add('isPublished')
            ->add('dateCreated')*/

            ->add('category', EntityType::class,[
                'label' => "Category",
                'choice_label' => "name",
                'class' => 'App\Entity\Category',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
