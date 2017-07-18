<?php

namespace Kardi\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function latestGalleriesAction($limit = 3)
    {
        $em = $this->getDoctrine()->getManager();
        $latestGalleries = $em->getRepository('KardiGalleryBundle:Gallery')
            ->getGalleries($limit);

        return $this->render('KardiGalleryBundle:Default:latest_galleries.html.twig', ['latestGalleries' => $latestGalleries]);
    }
}
