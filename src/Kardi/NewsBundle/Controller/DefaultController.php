<?php

namespace Kardi\NewsBundle\Controller;

use Kardi\NewsBundle\Form\Type\Comment;
use Kardi\NewsBundle\Form\Type\Search;
use Nietonfir\Google\ReCaptchaBundle\Controller\ReCaptchaValidationInterface;
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

    public function latestNewsAction($quantity = 6, $template)
    {
        $em = $this->getDoctrine()->getManager();
        $newsList = $em->getRepository('KardiNewsBundle:News')
            ->getLastNewsList(0, $quantity);

        return $this->render('KardiNewsBundle:Default:' . $template, ['newsList' => $newsList]);
    }

    public function lastNewsListBigImageAction($numberOfNews = 6)
    {
        $em = $this->getDoctrine()->getManager();
        $newsList = $em->getRepository('KardiNewsBundle:News')
            ->getLastNewsList($this->alreadyOnHomepage, $numberOfNews);

        return $this->render('KardiNewsBundle:Default:last_news_list_big_image.html.twig', ['newsList' => $newsList]);
    }

    public function lastCategoryNewsAction($categoryIdOrSlug, $quantity = 5, $template = 'last_category_news.html.twig')
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('KardiNewsBundle:Category');
        if (is_numeric($categoryIdOrSlug)) {
            $category->findOneBy(['id' => $categoryIdOrSlug]);
        } else {
            $category->getCategoryBySlug($categoryIdOrSlug);
        }
        if (!$category) {
            return new Response();
        }

        $newsList = $em->getRepository('KardiNewsBundle:News')
            ->getLastCategoryNewsList($categoryIdOrSlug, $quantity);

        return $this->render('KardiNewsBundle:Default:' . $template, ['newsList' => $newsList, 'category' => $category]);
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

            $em = $this->getDoctrine()->getManager();
            $newsRepo = $em->getRepository('KardiNewsBundle:News');
            $news = $newsRepo->find($newsId);
            if (empty($_POST['g-recaptcha-response'])) {
                $this->addFlash(
                    'comment.error',
                    'Missing captcha value'
                );
                $newsRoute = $this->container->get('kardi_news.provider.route.news')->generateNewsUrl($news);

                return $this->redirect($newsRoute);
            }

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

            $newsRoute = $this->container->get('kardi_news.provider.route.news')->generateNewsUrl($news);

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

        $paginator = $this->get('knp_paginator');
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

        $paginator = $this->get('knp_paginator');
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

        $page = $em->getRepository('KardiPageBundle:Page')
            ->getPageByType('news');


        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $newsListQuery,
            $request->query->getInt('page', 1),
            $this->categoryNewsNumber
        );

        return $this->render('KardiNewsBundle:Default:show_news_list.html.twig', [
            'pagination' => $pagination,
            'page' => $page
        ]);
    }

    public function searchNewsAction(Request $request)
    {
        $form = $this->createForm(Search::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $newsResultQuery = $em->getRepository('KardiNewsBundle:News')
                    ->searchForNewsesQuery($data['search'], $request->getLocale());

                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $newsResultQuery,
                    $request->query->getInt('page', 1),
                    $this->categoryNewsNumber
                );

                $page = $em->getRepository('KardiPageBundle:Page')
                    ->getPageByType('news');

                return $this->render('KardiNewsBundle:Default:search_news_list.html.twig', [
                    'pagination' => $pagination,
                    'page' => $page
                ]);

            } else {
                return $this->redirectToRoute('kardi_news_all');
            }
        }

        return $this->render('KardiNewsBundle:Default:search.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
