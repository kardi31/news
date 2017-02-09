<?php

namespace Kardi\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiLayoutBundle:Default:index.html.twig');
    }
}
