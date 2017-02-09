<?php

namespace Emigrant\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmigrantLayoutBundle:Default:index.html.twig');
    }
}
