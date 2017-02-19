<?php

namespace Kardi\FrameworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiFrameworkBundle:Default:index.html.twig');
    }
}
