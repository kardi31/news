<?php

namespace Kardi\NewsBundle\Controller;

use Kardi\MediaBundle\Event\MediaEvents;
use Kardi\MediaBundle\Event\PrePhotoEditEvent;
use Kardi\NewsBundle\Entity\NewsTranslation;
use Kardi\NewsBundle\Form\Type\Admin\News;
use Kardi\NewsBundle\Entity\News as NewsEntity;
use RecursiveDirectoryIterator;
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

    public function listNewsDataAction(Request $request)
    {
        $fields = [
            'n.id', '', 'nt.title', 'n.author', 'n.breakingNews', 'n.active', 'COUNT(c)', 'n.createdAt', 'n.publishDate'
        ];

        $data = $_GET;
        $em = $this->getDoctrine()->getManager();
        $newsList = $em->getRepository('KardiNewsBundle:News')
            ->getDatatableResults($fields, $data);

        $rows = [];
        foreach ($newsList as $news) {
            $row = [];

            $row[] = $news->getId();
            $row[] = sprintf('<img src="%s" />', $news->getPhoto()->getMainPhoto()->show('126x126'));
            $row[] = $news->trans('title');
            $row[] = $news->getAuthor();
            $row[] = $this->get('kardi_admin.helper.datatable')->displayToggle($news->getBreakingNews(), 'kardi_admin_news_toggle_breaking', $news->getId());
            $row[] = $this->get('kardi_admin.helper.datatable')->displayToggle($news->getActive(), 'kardi_admin_news_toggle_active', $news->getId());
            $row[] = $news->getComments()->count();
            $row[] = $news->getCreatedAt()->format('d/m/Y H:i');
            $row[] = $news->getPublishDate()->format('d/m/Y H:i');
            $row[] = '';
            $rows[] = $row;
        }

        return new JsonResponse([
            'data' => $rows,
            'recordsTotal' => count($rows),
            'recordsFiltered' => count($rows)
        ]);
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
        $pageTitle = sprintf('Edytuj news %s', $news->trans('title'));

        $this->get('event_dispatcher')->dispatch(MediaEvents::PRE_PHOTO_EDIT, new PrePhotoEditEvent('kardinewsbundle_news', $pageTitle));

        $form = $this->createForm(News::class, $news);

        return $this->render('KardiNewsBundle:Admin:edit_news.html.twig', ['form' => $form->createView(), 'news' => $news, 'pageTitle' => $pageTitle]);
    }

    public function toggleActiveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('KardiNewsBundle:News')
            ->find($id);

        if (!$news) {
            throw new \Exception('News nie istnieje');
        }

        $news->setActive(!$news->getActive());
        $em->persist($news);
        $em->save();

        return $this->redirect($this->generateUrl('kardi_admin_news'));
    }


    public function toggleBreakingAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('KardiNewsBundle:News')
            ->find($id);

        if (!$news) {
            throw new \Exception('News nie istnieje');
        }

        $news->setActive(!$news->getActive());
        $em->persist($news);
        $em->save();

        return $this->redirect($this->generateUrl('kardi_admin_news'));
    }
}
