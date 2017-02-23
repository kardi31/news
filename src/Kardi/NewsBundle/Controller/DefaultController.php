<?php

namespace Kardi\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function breakingNewsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $breakingNews = $em->getRepository('KardiNewsBundle:News')
            ->getBreakingNews();

        return $this->render('KardiNewsBundle:Default:breaking_news.html.twig', ['breakingNews' => $breakingNews]);
    }

    public function showNewsAction()
    {
        dump('shownews');exit;
    }
}
