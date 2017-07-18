<?php

namespace Kardi\GalleryBundle\Form\Type\Admin;

use Kardi\AdminBundle\Form\Type\TranslationForm;
use Kardi\GalleryBundle\Entity\GalleryTranslation;
use Kardi\GalleryBundle\Entity\Gallery as GalleryEntity;
use Kardi\GalleryBundle\Provider\CategoryProvider;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Gallery extends AbstractType
{
    /**
     * @var CategoryProvider
     */
    private $categoryProvider;

    public function __construct(CategoryProvider $categoryProvider)
    {
        $this->categoryProvider = $categoryProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('publishDate', DateTimeType::class, ['label' => 'Data publikacji',
            'widget' => 'single_text',

            'format' => 'dd-MM-yyyy HH:mm'
        ]);
        $builder->add('active', CheckboxType::class, ['compound' => false, 'label' => 'Aktywny', 'required' => false]);
//        $builder->add('featured', CheckboxType::class, ['compound' => false, 'label' => 'Ważny news', 'required' => false]);
        $builder->add('categoryId', ChoiceType::class, ['choices' => $this->categoryProvider->prependCategories(), 'label' => 'Kategoria']);
        $builder->add('submit', SubmitType::class, ['attr' => ['class' => 'button'], 'label' => 'Zapisz']);

        $builder->add('translations', CollectionType::class, [
            'entry_type' => TranslationForm::class,
            'entry_options' => [
                'data_class' => GalleryTranslation::class
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GalleryEntity::class
        ));
    }
}
