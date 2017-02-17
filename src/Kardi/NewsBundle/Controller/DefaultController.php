<?php

namespace Kardi\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiNewsBundle:Default:index.html.twig');
    }
}
