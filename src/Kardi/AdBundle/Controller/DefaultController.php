<?php

namespace Kardi\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function topAdsAction()
    {
        return $this->render('KardiAdBundle:Default:top-ads.html.twig');
    }

    public function displayAdAction($size)
    {
        $em = $this->getDoctrine()->getManager();
        $ad = $em->getRepository('KardiAdBundle:Advertisment')
            ->getOneAdvertismentBySize($size);

        return $this->render('KardiAdBundle:Default:display-ad.html.twig', ['ad' => $ad, 'size' => $size]);
    }
}
