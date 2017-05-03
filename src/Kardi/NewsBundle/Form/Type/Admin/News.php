<?php

namespace Kardi\NewsBundle\Form\Type\Admin;

use Kardi\NewsBundle\Entity\News as NewsEntity;
use Kardi\NewsBundle\Provider\CategoryProvider;
use Kardi\NewsBundle\Provider\TagProvider;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class News extends AbstractType
{
    /**
     * @var CategoryProvider
     */
    private $categoryProvider;
    /**
     * @var TagProvider
     */
    private $tagProvider;

    public function __construct(CategoryProvider $categoryProvider, TagProvider $tagProvider)
    {
        $this->categoryProvider = $categoryProvider;
        $this->tagProvider = $tagProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author', null, ['attr' => ['placeholder' => 'comment.placeholder.name'], 'label' => 'Autor']);
        $builder->add('publishDate', DateTimeType::class, ['label' => 'Data publikacji',
            'widget' => 'single_text',

            'format' => 'dd-MM-yyyy HH:mm'
        ]);
        $builder->add('active', CheckboxType::class, ['compound' => false, 'label' => 'Aktywny', 'required' => false, 'data' => false]);
        $builder->add('breakingNews', CheckboxType::class, ['compound' => false, 'label' => 'Ważny news', 'required' => false, 'data' => false]);
        $builder->add('categoryId', ChoiceType::class, ['choices' => $this->categoryProvider->prependCategories(), 'label' => 'Kategoria']);
        $builder->add('submit', SubmitType::class, ['attr' => ['class' => 'button'], 'label' => 'Zapisz']);

        $builder->add('translations', CollectionType::class, [
            'entry_type' => NewsTranslation::class
        ]);

        $builder->add(
            'tags',
            EntityType::class,
            [
                'class' => 'Kardi\NewsBundle\Entity\Tag',
                'choices' => $this->tagProvider->prependTags(),
                'choice_value' => 'id',
                'choice_label' => function ($tag) {
                    return $tag->trans('title');
                },
                'multiple' => true,
                'label' => 'Tagi',
                'attr' =>
                    [
                        'class' => 'select2-multiple'
                    ]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => NewsEntity::class
        ));
    }
}
