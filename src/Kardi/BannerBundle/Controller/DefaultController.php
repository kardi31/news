<?php

namespace Kardi\BannerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function topBannersAction()
    {
        return $this->render('KardiBannerBundle:Default:top-banners.html.twig');
    }

    public function displayBannerAction($size)
    {
        $em = $this->getDoctrine()->getManager();
        $banner = $em->getRepository('KardiBannerBundle:Banner')
            ->getOneBannerBySize($size);

        return $this->render('KardiBannerBundle:Default:display-banner.html.twig', ['banner' => $banner, 'size' => $size]);
    }
}
