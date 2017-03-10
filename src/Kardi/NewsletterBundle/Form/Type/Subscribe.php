<?php

namespace Kardi\NewsletterBundle\Form\Type;

use Kardi\NewsletterBundle\Entity\Subscriber;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Subscribe extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, ['mapped' => false, 'attr' => ['placeholder' => 'subscribe.name'], 'label' => false]);
        $builder->add('email', EmailType::class, ['attr' => ['placeholder' => 'subscribe.email'], 'compound' => false, 'label' => false]);
        $builder->add('subscribe', SubmitType::class, ['attr' => ['class' => 'button' ], 'label' => 'subscribe.submit']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Subscriber::class
        ));
    }
}
