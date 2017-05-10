<?php

namespace Kardi\NewsBundle\Controller;

use Kardi\NewsBundle\Entity\NewsTranslation;
use Kardi\NewsBundle\Form\Type\Admin\News;
use Kardi\NewsBundle\Entity\News as NewsEntity;
use stojg\crop\CropCenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function listNewsAction()
    {
        return $this->render('KardiNewsBundle:Admin:list_news.html.twig');
    }

    public function addNewsAction()
    {
        $news = new NewsEntity();
//
//        $plTranslation = new NewsTranslation();
//        $plTranslation->setLang('pl');
//
//        $enTranslation = new NewsTranslation();
//        $enTranslation->setLang('en');
//
//        $news->getTranslations()->add($plTranslation);
//        $news->getTranslations()->add($enTranslation);

        $form = $this->createForm(News::class, $news);

        return $this->render('KardiNewsBundle:Admin:edit_news.html.twig', ['form' => $form->createView()]);
    }

    public function editNewsAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('KardiNewsBundle:News')
            ->find($id);

        if (!$news) {
            throw new \Exception('News nie istnieje');
        }


        $form = $this->createForm(News::class, $news);

        return $this->render('KardiNewsBundle:Admin:edit_news.html.twig', ['form' => $form->createView(), 'news' => $news]);
    }
}
