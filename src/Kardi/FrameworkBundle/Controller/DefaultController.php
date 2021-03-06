<?php

namespace Kardi\FrameworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function socialNumbersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('KardiFrameworkBundle:Settings')
                ->getSettings();

        return $this->render('KardiFrameworkBundle:Default:social-numbers.html.twig', ['settings' => $settings]);
    }
}
