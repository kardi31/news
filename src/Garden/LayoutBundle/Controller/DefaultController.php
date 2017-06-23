<?php

namespace Garden\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $homepage = $em->getRepository('KardiPageBundle:Page')
            ->getHomepage();

        return $this->render('GardenLayoutBundle:Default:index.html.twig', ['homepage' => $homepage]);
    }
}
