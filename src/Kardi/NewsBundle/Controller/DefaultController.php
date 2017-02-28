<?php

namespace Kardi\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function breakingNewsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $breakingNews = $em->getRepository('KardiNewsBundle:News')
            ->getBreakingNews();

        $templating = $this->container->get('templating');

        $response = new Response($templating->render(
            'KardiNewsBundle:Default:breaking_news.html.twig',
            ['breakingNews' => $breakingNews]
        ));
        return $response;
//        return $this->render(, );
    }

    public function showNewsAction($slug, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('KardiNewsBundle:News')
            ->find($id);

        return $this->render('KardiNewsBundle:Default:show_news.html.twig', ['news' => $news]);
    }
}
