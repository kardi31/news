<?php

namespace Emigrant\NewsBundle\Controller;

use Kardi\NewsBundle\Form\Type\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * Displays number of newses which are already on homepage. E.g.
     * @var int
     */
    protected $alreadyOnHomepage = 1;
    private $categoryNewsNumber = 10;

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

        $relatedArticles = $em->getRepository('KardiNewsBundle:News')
            ->getLastCategoryNewsList($news->getCategoryId(), 5);

        $comments = $em->getRepository('KardiNewsBundle:Comment')
            ->getNewsMainComments($news->getId());


        $commentsTotal = $em->getRepository('KardiNewsBundle:Comment')
            ->countAllNewsComments($news->getId());

        return $this->render('KardiNewsBundle:Default:show_news.html.twig', [
            'news' => $news,
            'relatedArticles' => $relatedArticles,
            'comments' => $comments,
            'commentsTotal' => $commentsTotal
        ]);
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

    public function lastCategoryNewsAction($categorySlug, $numberOfNews = 5)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('KardiNewsBundle:Category')
            ->getCategoryBySlug($categorySlug);

        if (!$category) {
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

    public function addCommentAction(Request $request, $newsId, $parentId = null)
    {
        $commentForm = $this->createForm(Comment::class);
        $commentForm->get('parent_id')->setData($parentId);
        $commentForm->get('news_id')->setData($newsId);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $comment = $commentForm->getData();
            $comment->setIp($_SERVER['REMOTE_ADDR']);
            $comment->setHostname(gethostbyaddr($_SERVER['REMOTE_ADDR']));

            $moderateComments = $this->container->getParameter('comments_moderate');
            $comment->setActive(!$moderateComments);

            $em = $this->getDoctrine()->getManager();

            if ($parentId) {
                $repo = $em->getRepository('KardiNewsBundle:Comment');
                $parent = $repo->find($parentId);
                if ($parent) {
                    $repo->persistAsLastChildOf($comment, $parent);
                } else {
                    $repo->persistAsLastChild($comment);
                }
            }

            $newsRepo = $em->getRepository('KardiNewsBundle:News');
            $news = $newsRepo->find($newsId);

            $comment->setNews($news);

            $em->persist($comment);
            $em->flush();

            if ($moderateComments) {
                $message = 'comment.moderate.success';
            } else {
                $message = 'comment.success';
            }

            $this->addFlash(
                'comment.success',
                $message
            );

            $newsRouter = $this->container->get('kardi_news.router.news');

            $newsRoute = $newsRouter->generateNewsUrl($news);
            return $this->redirect($newsRoute);
        }

        return $this->render('KardiNewsBundle:Default:add_comment.html.twig', [
            'commentForm' => $commentForm->createView(),
            'newsId' => $newsId,
            'parentId' => $parentId
        ]);
    }

    public function showCategoryAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('KardiNewsBundle:Category')
            ->getCategoryBySlug($slug);

        $newsListQuery = $em->getRepository('KardiNewsBundle:News')
            ->getCategoryNewsListQuery($category->getId(), null);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $newsListQuery,
            $request->query->getInt('page', 1),
            $this->categoryNewsNumber
        );

        return $this->render('KardiNewsBundle:Default:show_category.html.twig', [
            'pagination' => $pagination,
            'category' => $category
        ]);
    }

    public function showTagNewsListAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('KardiNewsBundle:Tag')
            ->getTagBySlug($slug);

        $newsListQuery = $em->getRepository('KardiNewsBundle:News')
            ->getTagNewsListQuery($tag->getId(), null);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $newsListQuery,
            $request->query->getInt('page', 1),
            $this->categoryNewsNumber
        );

        return $this->render('KardiNewsBundle:Default:show_tag_news_list.html.twig', [
            'pagination' => $pagination,
            'tag' => $tag
        ]);
    }

    public function showAllNewsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $newsListQuery = $em->getRepository('KardiNewsBundle:News')
            ->getAllNewsListQuery(null);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $newsListQuery,
            $request->query->getInt('page', 1),
            $this->categoryNewsNumber
        );

        return $this->render('KardiNewsBundle:Default:show_news_list.html.twig', [
            'pagination' => $pagination
        ]);
    }
}
