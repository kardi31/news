<?php

namespace Kardi\NewsBundle\Form\Type\Admin;

use Kardi\AdminBundle\Form\Type\TranslationForm;
use Kardi\NewsBundle\Entity\Tag as TagEntity;
use Kardi\NewsBundle\Entity\TagTranslation;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Tag extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('submit', SubmitType::class, ['attr' => ['class' => 'button'], 'label' => 'Zapisz']);

        $builder->add('translations', CollectionType::class, [
            'entry_type' => TranslationForm::class,
            'entry_options' => [
                'data_class' => TagTranslation::class,
                'label_attr' => ['hide_content' => true]
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TagEntity::class
        ));
    }
}
