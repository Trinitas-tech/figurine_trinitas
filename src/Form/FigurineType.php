<?php

namespace App\Form;

use App\Entity\Figurine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de création / modification d'une figurine.
 * Les règles de validation sont portées par l'entité Figurine.
 */
class FigurineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => ['placeholder' => 'Ex : Goku Super Saiyan - Banpresto'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['rows' => 5, 'placeholder' => 'Marque, échelle, édition, état...'],
            ])
            ->add('imageName', UrlType::class, [
                'label' => "URL de l'image",
                'default_protocol' => 'https',
                'help' => "Lien direct et public vers l'image (jpg, png, webp).",
                'attr' => ['placeholder' => 'https://exemple.com/ma-figurine.jpg'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Figurine::class,
        ]);
    }
}
