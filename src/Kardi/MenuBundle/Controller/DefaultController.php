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

//        if(!$menu){
//            throw new \Exception('Main menu not found');
//        }

        return $this->render('KardiMenuBundle:Default:main-menu.html.twig', ['menu' => $menu]);
    }

    public function secondaryMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('KardiMenuBundle:Menu')
            ->getSecondaryMenu();

//        if(!$menu){
//            throw new \Exception('Secondary menu not found');
//        }

        return $this->render('KardiMenuBundle:Default:secondary-menu.html.twig', ['menu' => $menu]);
    }
}
