<?php

namespace Kardi\NewsletterBundle\Form\Type;

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

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'row_attr' => array()
//        ));
////        $resolver->setDefaults([
////            'data_class' => 'Phoenix\Bundle\SubscriptionsBundle\Entity\EmailSubscription',
////        ]);
//    }

//    public function getName()
//    {
//        return 'subscribe';
//    }
}
