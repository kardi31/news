<?php

namespace Kardi\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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

        return $this->render('KardiNewsBundle:Default:breaking_news.html.twig', ['breakingNews' => $breakingNews]);
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

        return $this->render('KardiNewsBundle:Default:latest_news_big_image.html.twig', ['news' => $latestNews]);
    }

    public function lastNewsListBigImageAction($numberOfNews = 6)
    {
        $em = $this->getDoctrine()->getManager();
        $newsList = $em->getRepository('KardiNewsBundle:News')
            ->getLastNewsList($this->alreadyOnHomepage, $numberOfNews);

        return $this->render('KardiNewsBundle:Default:last_news_list_big_image.html.twig', ['newsList' => $newsList]);
    }

    public function lastCategoryNewsAction($categorySlug,$numberOfNews = 5)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('KardiNewsBundle:Category')
            ->getCategoryBySlug($categorySlug);

        if(!$category)
        {
            return new Response();
        }

        $newsList = $em->getRepository('KardiNewsBundle:News')
            ->getLastCategoryNewsList($category->getId(), $numberOfNews);

        return $this->render('KardiNewsBundle:Default:last_category_news.html.twig', ['newsList' => $newsList, 'category' => $category]);
    }

    public function latestCommentsAction($numberOfComments = 3)
    {
        $em = $this->getDoctrine()->getManager();
        $latestComments = $em->getRepository('KardiNewsBundle:Comment')
            ->getLatestComments($numberOfComments);
        return $this->render('KardiNewsBundle:Default:last_comments.html.twig', ['comments' => $latestComments]);
    }
    
    public function popularTagsAction($limit = 10)
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('KardiNewsBundle:Tag')
            ->getPopularTags($limit);

        return $this->render('KardiNewsBundle:Default:popular_tags.html.twig', ['tags' => $tags]);
    }
}
