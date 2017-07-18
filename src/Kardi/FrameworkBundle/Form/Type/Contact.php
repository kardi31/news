<?php

namespace Kardi\FrameworkBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

class Contact extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, ['label' => 'contact.name']);
        $builder->add('email', EmailType::class, ['label' => 'contact.email']);
        $builder->add('message', TextareaType::class, ['label' => 'contact.message']);
        $builder->add('recaptcha', EWZRecaptchaType::class, ['attr' => [
            'options' => [
                'theme' => 'light',
                'type' => 'image',
                'size' => 'normal'
            ]
        ],
            'label' => false,
            'mapped' => false,
            'constraints' => [new RecaptchaTrue()]]
        );
        $builder->add('submit', SubmitType::class, ['attr' => ['class' => 'button'], 'label' => 'contact.submit']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \Kardi\FrameworkBundle\Entity\Contact::class,
        ));
    }
}
