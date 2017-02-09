<?php

namespace Kardi\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiMenuBundle:Default:index.html.twig');
    }
}
