<?php

namespace Kardi\AdminBundle\Form\Type;

use Kardi\NewsBundle\Entity\NewsTranslation as NewsTranslationEntity;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, ['label' => 'Tytuł']);

        if (!(isset($options['label_attr']['hide_content']) && $options['label_attr']['hide_content'])) {
            $builder->add('content', TextareaType::class, ['label' => 'Treść', 'required' => false]);
        }

        $builder->add('lang', HiddenType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsTranslationEntity::class
        ]);
    }
}
