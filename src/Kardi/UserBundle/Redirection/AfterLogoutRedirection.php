<?php

namespace Kardi\UserBundle\Redirection;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class AfterLogoutRedirection implements LogoutSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AfterLogoutRedirection constructor.
     * @param RouterInterface $router
     * @param $tokenStorage
     */
    public function __construct(RouterInterface $router, $tokenStorage)
    {
        $this->router = $router;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function onLogoutSuccess(Request $request)
    {
        // Get list of roles for current user
        $roles = $this->tokenStorage->getToken()->getRoles();
        // Tranform this list in array
        $rolesTab = array_map(function($role){
            return $role->getRole();
        }, $roles);

        // If is a commercial user or admin or super admin we redirect to the login area. Here we used FoseUserBundle bundle
        if (in_array('ROLE_COMMERCIAL', $rolesTab, true) || in_array('ROLE_ADMIN', $rolesTab, true) || in_array('ROLE_SUPER_ADMIN', $rolesTab, true))
            $response = new RedirectResponse($this->router->generate('kardi_admin_login'));
        // otherwise we redirect user to the homepage of website
        else
            $response = new RedirectResponse($this->router->generate('kardi_homepage'));

        return $response;
    }
}
