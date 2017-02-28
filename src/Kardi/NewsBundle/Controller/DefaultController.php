<?php

namespace Kardi\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Displays number of newses which are already on homepage. E.g.
     * @var int
     */
    protected $alreadyOnHomepage = 1;

    public function breakingNewsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $breakingNews = $em->getRepository('KardiNewsBundle:News')
            ->getBreakingNews();

        return $this->render(
            'KardiNewsBundle:Default:breaking_news.html.twig',
            ['breakingNews' => $breakingNews]
        );
    }

    public function showNewsAction($slug, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('KardiNewsBundle:News')
            ->find($id);

        return $this->render('KardiNewsBundle:Default:show_news.html.twig', ['news' => $news]);
    }

    public function latestNewsBigImageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $latestNews = $em->getRepository('KardiNewsBundle:News')
            ->getLatestNews();

        return $this->render('KardiNewsBundle:Default:latest_news_big_image.html.twig', ['latestNews' => $latestNews]);
    }

    public function lastNewsListBigImageAction($numberOfNews = 6)
    {
        $em = $this->getDoctrine()->getManager();
        $newsList = $em->getRepository('KardiNewsBundle:News')
            ->getLastNewsList($this->alreadyOnHomepage, $numberOfNews);

        return $this->render('KardiNewsBundle:Default:last_news_list_big_image.html.twig', ['newsList' => $newsList]);
    }
}
