<?php

namespace Garden\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function showAction($slug, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('KardiGalleryBundle:Gallery')
            ->find($id);

        if (!$gallery) {
            throw new \Exception('Gallery not found');
        }

        return $this->render('GardenGalleryBundle:Default:show.html.twig', ['gallery' => $gallery]);
    }

    public function listGalleryAction()
    {
        $em = $this->getDoctrine()->getManager();
        $galleries = $em->getRepository('KardiGalleryBundle:Gallery')
            ->getGalleries();

        $page = $em->getRepository('KardiPageBundle:Page')
            ->getPageByType('gallery');

        if (!$page) {
            throw new \Exception('Page not found');
        }

        return $this->render('GardenGalleryBundle:Default:list-gallery.html.twig', ['galleries' => $galleries, 'page' => $page]);
    }
}
