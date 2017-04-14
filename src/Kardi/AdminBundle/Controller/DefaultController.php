<?php

namespace Kardi\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiAdminBundle:Default:index.html.twig');
    }
}
