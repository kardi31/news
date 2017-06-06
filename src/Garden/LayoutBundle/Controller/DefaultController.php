<?php

namespace Garden\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GardenLayoutBundle:Default:index.html.twig');
    }
}
