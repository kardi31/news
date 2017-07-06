<?php

namespace Garden\NewsBundle\Controller;

use Kardi\NewsBundle\Controller\DefaultController as BaseController;
use Kardi\NewsBundle\Form\Type\Search;
use Nietonfir\Google\ReCaptchaBundle\Controller\ReCaptchaValidationInterface;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    private $categoryNewsNumber = 10;

    public function showAllNewsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('KardiNewsBundle:News')
            ->getAllNewsListQuery(null);
        $template = 'KardiNewsBundle:Default:show_news_list.html.twig';

        return $this->prepareNewsRender($query, $template, $request);
    }

    public function searchNewsAction(Request $request)
    {
        $form = $this->createForm(Search::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $query = $em->getRepository('KardiNewsBundle:News')
                    ->searchForNewsesQuery($data['search'], $request->getLocale());
                $template = 'KardiNewsBundle:Default:search_news_list.html.twig';

                return $this->prepareNewsRender($query, $template, $request);

            } else {
                return $this->redirectToRoute('kardi_news_all');
            }
        }

        return $this->render('KardiNewsBundle:Default:search.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function prepareNewsRender($query, $template, $request)
    {
        $em = $this->getDoctrine()->getManager();

        $page = $em->getRepository('KardiPageBundle:Page')
            ->getPageByType('news');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $this->categoryNewsNumber
        );
        $pagination->setTemplate('KnpPaginatorBundle:Pagination:twitter_bootstrap_v3_pagination.html.twig');


        return $this->render($template, [
            'pagination' => $pagination,
            'page' => $page
        ]);
    }

    public function renderSidebarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('KardiNewsBundle:Category')
            ->getAllCategories($request->getLocale(), ['ct.title', 'ASC']);

        $tags = $em->getRepository('KardiNewsBundle:Tag')
            ->getPopularTags(10);

        $showLatestNews = $request->attributes->get('showLatestNews');
        $latestNews = false;

        if ($showLatestNews) {
            $latestNews = $em->getRepository('KardiNewsBundle:News')
                ->getLastNewsList(0, 3, $request->attributes->get('currentNews'));
        }


        return $this->render('GardenNewsBundle:Default:sidebar.html.twig', [
            'categories' => $categories,
            'tags' => $tags,
            'latestNews' => $latestNews,
            'showLatestNews' => $showLatestNews
        ]);
    }

    public function showCategoryAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('KardiNewsBundle:Category')
            ->getCategoryBySlug($slug);

        $newsListQuery = $em->getRepository('KardiNewsBundle:News')
            ->getCategoryNewsListQuery($category->getId(), null);

        $page = $em->getRepository('KardiPageBundle:Page')
            ->getPageByType('news');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $newsListQuery,
            $request->query->getInt('page', 1),
            $this->categoryNewsNumber
        );

        return $this->render('GardenNewsBundle:Default:show_category.html.twig', [
            'pagination' => $pagination,
            'category' => $category,
            'page' => $page
        ]);
    }

    public function showTagNewsListAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('KardiNewsBundle:Tag')
            ->getTagBySlug($slug);


        $page = $em->getRepository('KardiPageBundle:Page')
            ->getPageByType('news');

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
}
