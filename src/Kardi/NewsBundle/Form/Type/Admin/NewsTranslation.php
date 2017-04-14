<?php

namespace Kardi\NewsBundle\Form\Type\Admin;

use Kardi\NewsBundle\Entity\NewsTranslation as NewsTranslationEntity;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsTranslation extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, ['label' => 'Tytuł']);
        $builder->add('content', TextareaType::class, ['label' => 'Treść']);
        $builder->add('lang', HiddenType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => NewsTranslationEntity::class
        ));
    }
}
