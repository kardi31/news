<?php

namespace Kardi\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiPageBundle:Default:index.html.twig');
    }

    public function contactAction()
    {
        $ApplicationName = $this->container->getParameter('application_name');

        return $this->render('KardiPageBundle:Default:contact.html.twig', ['ApplicationName' => $ApplicationName]);
    }
}
