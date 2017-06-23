<?php

namespace Kardi\NewsBundle\Form\Type\Admin;

use Kardi\AdminBundle\Form\Type\TranslationForm;
use Kardi\NewsBundle\Entity\Category as CategoryEntity;
use Kardi\NewsBundle\Entity\CategoryTranslation;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Category extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('submit', SubmitType::class, ['attr' => ['class' => 'button'], 'label' => 'Zapisz']);

        $builder->add('active', CheckboxType::class, ['compound' => false, 'label' => 'Aktywna', 'required' => false, 'data' => true]);
        $builder->add('translations', CollectionType::class, [
            'entry_type' => TranslationForm::class,
            'entry_options' => [
                'data_class' => CategoryTranslation::class
            ]]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CategoryEntity::class
        ));
    }
}
