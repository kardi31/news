<?php

namespace Kardi\NewsBundle\Form\Type;

use Kardi\NewsBundle\Entity\Comment as CommentEntity;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Comment extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author', null, ['attr' => ['placeholder' => 'comment.placeholder.name'], 'label' => 'comment.name']);
        $builder->add('email', EmailType::class, ['attr' => ['placeholder' => 'comment.placeholder.email'], 'compound' => false, 'label' => 'comment.email']);
        $builder->add('content', TextareaType::class, ['attr' => ['placeholder' => 'comment.comment'], 'compound' => false, 'label' => false]);
        $builder->add('parent_id', HiddenType::class, [ 'compound' => false, 'label' => false]);
        $builder->add('news_id', HiddenType::class, ['compound' => false, 'label' => false]);
        $builder->add('submit_comment', SubmitType::class, ['attr' => ['class' => 'button' ], 'label' => 'comment.submit']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CommentEntity::class
        ));
    }
}
