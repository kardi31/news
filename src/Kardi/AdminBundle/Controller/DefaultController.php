<?php

namespace Kardi\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $newsCount = $em->getRepository('KardiNewsBundle:News')->countActiveArticles();
        $commentCount = $em->getRepository('KardiNewsBundle:Comment')->countActiveComments();
        $galleryCount = $em->getRepository('KardiGalleryBundle:Gallery')->countActiveGalleries();
        $adminCount = $em->getRepository('KardiUserBundle:User')->countActiveAdminUsers();


        return $this->render('KardiAdminBundle:Default:index.html.twig',[
            'newsCount' => $newsCount,
            'commentCount' => $commentCount,
            'galleryCount' => $galleryCount,
            'adminCount' => $adminCount
        ]);
    }
}
