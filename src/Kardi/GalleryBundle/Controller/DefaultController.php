<?php

namespace Kardi\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KardiGalleryBundle:Default:index.html.twig');
    }
}
