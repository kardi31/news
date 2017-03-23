<?php

namespace Kardi\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiMediaBundle:Default:index.html.twig');
    }
}
