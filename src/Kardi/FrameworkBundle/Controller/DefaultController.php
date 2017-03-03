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

        $facebookService = $this->container->get('kardi.framework.facebook_service');
//var_dump($settings->getFacebook());exit;
//        $facebookId = $settings->getFacebookId();

        $facebookId = 371309372997823;
        $facebookFollowers = $facebookService->getNumberOfFollowers($facebookId);

        return $this->render('KardiFrameworkBundle:Default:social-numbers.html.twig', ['settings' => $settings]);
    }
}
