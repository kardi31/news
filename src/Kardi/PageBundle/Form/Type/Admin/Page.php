<?php

namespace Kardi\PageBundle\Form\Type\Admin;

use Kardi\AdminBundle\Form\Type\TranslationForm;
use Kardi\PageBundle\Entity\PageTranslation;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Kardi\PageBundle\Entity\Page as PageEntity;

class Page extends TranslationForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', TextType::class,
            [
                'label' => 'Typ strony'
            ]
        );

        $builder->add('submit', SubmitType::class, ['attr' => ['class' => 'button'], 'label' => 'Zapisz']);

        $builder->add('translations', CollectionType::class, [
            'entry_type' => TranslationForm::class,
            'entry_options' => [
                'data_class' => PageTranslation::class
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => PageEntity::class
        ));
    }
}
