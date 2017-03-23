<?php

namespace Kardi\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function latestAdsAction(Request $request, $limit = 6)
    {
        $locale = $request->getLocale();

        $em = $this->getDoctrine()->getManager();
        $latestAds = $em->getRepository('KardiAdBundle:Ad')
            ->getLatestAds($locale, $limit);

        return $this->render('KardiAdBundle:Default:latest_ads.html.twig', ['ads' => $latestAds]);
    }
}
