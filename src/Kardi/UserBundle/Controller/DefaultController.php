<?php

namespace Kardi\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiUserBundle:Default:index.html.twig');
    }
}
