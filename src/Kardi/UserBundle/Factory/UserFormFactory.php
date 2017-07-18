<?php

namespace Kardi\UserBundle\Factory;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;

class UserFormFactory
{
    private $adminPermissions = [
        'ROLE_ADMIN_USER' => 'Administrator',
        'ROLE_SUPER_ADMIN' => 'Super administrator'
    ];

    /**
     * @param FormInterface $form
     */
    public function prepareAdminFormWithRoles(FormInterface $form)
    {
        $form->add('roles', ChoiceType::class, [
            'label' => 'form.role',
            'choices' => array_flip($this->adminPermissions),
            'multiple' => true
        ]);
    }

    /**
     * @param FormInterface $form
     */
    public function prepareEditAdminForm(FormInterface $form)
    {
        $form->remove('plainPassword');
        $form->remove('current_password');
        $this->prepareAdminFormWithRoles($form);
    }
}
