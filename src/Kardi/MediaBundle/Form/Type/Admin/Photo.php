<?php

namespace Kardi\MediaBundle\Form\Type\Admin;

use Kardi\MediaBundle\Entity\Photo as PhotoEntity;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Photo extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photo', FileType::class, ['required' => false]);
        $builder->add('submit', SubmitType::class, ['attr' => ['class' => 'button' ], 'label' => 'comment.submit']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
//        $resolver->setDefaults(array(
//            'data_class' => PhotoEntity::class
//        ));
    }
}
