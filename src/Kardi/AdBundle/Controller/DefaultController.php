<?php

namespace Kardi\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function topAdsAction()
    {
        return $this->render('KardiAdBundle:Default:top-ads.html.twig');
    }
}
