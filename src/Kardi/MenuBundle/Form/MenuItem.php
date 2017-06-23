<?php

namespace Kardi\MenuBundle\Form;

use Kardi\AdminBundle\Form\Type\TranslationForm;
use Kardi\MenuBundle\Entity\MenuItemTranslation;
use Kardi\MenuBundle\Provider\LinkableRouteProvider;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuItem extends AbstractType
{
    /**
     * @var LinkableRouteProvider
     */
    private $linkableRouteProvider;

    public function __construct(LinkableRouteProvider $linkableRouteProvider)
    {
        $this->linkableRouteProvider = $linkableRouteProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('submit', SubmitType::class, ['attr' => ['class' => 'button'], 'label' => 'Zapisz']);

        $builder->add('pos', HiddenType::class);
        $builder->add('parent', HiddenType::class);
        $builder->add('route', ChoiceType::class, ['choices' => $this->linkableRouteProvider->prepareRoutesForForm(), 'label' => 'Ścieżka']);

        $builder->add('translations', CollectionType::class, [
            'entry_type' => TranslationForm::class,
            'entry_options' => [
                'data_class' => MenuItemTranslation::class,
                'label_attr' => ['hide_content' => true]
            ]]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \Kardi\MenuBundle\Entity\MenuItem::class
        ));
    }
}
