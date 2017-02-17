<?php

namespace Kardi\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiMenuBundle:Default:index.html.twig');
    }

    public function mainMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('KardiMenuBundle:Menu')
            ->getMainMenu();

        return $this->render('KardiMenuBundle:Default:main-menu.html.twig', ['menu' => $menu]);
    }
}
