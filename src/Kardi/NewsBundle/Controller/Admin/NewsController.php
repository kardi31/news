<?php

namespace Kardi\NewsBundle\Controller\Admin;

use Kardi\MediaBundle\Event\MediaEvents;
use Kardi\MediaBundle\Event\PrePhotoEditEvent;
use Kardi\NewsBundle\Command\AddNewsCommand;
use Kardi\NewsBundle\Command\DeleteNewsCommand;
use Kardi\NewsBundle\Entity\NewsTranslation;
use Kardi\NewsBundle\Form\Type\Admin\News;
use Kardi\NewsBundle\Entity\News as NewsEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    public function listNewsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $request->getLocale();

        $categoryNames = $em->getRepository('KardiNewsBundle:Category')->getCategoryNames($locale);

        return $this->render('KardiNewsBundle:Admin/News:list_news.html.twig', ['categoryNames' => $categoryNames]);
    }

    public function listNewsDataAction(Request $request)
    {
        $fields = [
            'n.id', '', 'nt.title', 'n.author', 'n.active', 'n.breakingNews', 'cat.id ', 'comment_count', 'n.createdAt', 'n.publishDate'
        ];

        $data = $_GET;
        $em = $this->getDoctrine()->getManager();

        $newsRepository = $em->getRepository('KardiNewsBundle:News');
        $newsList = $newsRepository->getDatatableResults($fields, $data, null, $request->getLocale());
        $countNewsList = $newsRepository->countDatatableResults($fields, $data, null, $request->getLocale());
        $rows = [];
        foreach ($newsList as $newsListRow) {
            $news = $newsListRow[0];
            $row = [];

            $row[] = $news->getId();

            $row[] = sprintf('<img src="%s" />', $news->getPhoto()->getMainPhoto()->show('126x126'));
            $row[] = $news->trans('title');
            $row[] = $news->getAuthor();
            $row[] = $this->get('kardi_admin.helper.datatable')->displayToggle($news->getActive(), 'kardi_admin_news_toggle_active', $news->getId());
            $row[] = $this->get('kardi_admin.helper.datatable')->displayToggle($news->getBreakingNews(), 'kardi_admin_news_toggle_breaking', $news->getId());
            $row[] = $news->getCategory()->trans('title');
            $row[] = $news->getComments()->count();
            $row[] = $news->getCreatedAt()->format('d/m/Y H:i');
            $row[] = $news->getPublishDate()->format('d/m/Y H:i');

            $options = $this->get('kardi_admin.helper.datatable')->displayLink('kardi_admin_edit_news', $news->getId(), 'edit');
            $options .= ' ' . $this->get('kardi_admin.helper.datatable')->displayLink('kardi_admin_delete_news', $news->getId(), 'times', 'delete');

            $row[] = $options;
            $rows[] = $row;
        }

        return new JsonResponse([
            'data' => $rows,
            'recordsFiltered' => $countNewsList,
            'recordsTotal' => count($rows),
        ]);
    }

    public function addNewsAction(Request $request)
    {
        $news = $this->get('kardi_news.service.news')->createEmptyNewsWithTranslations();

        $form = $this->createForm(News::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $addNewsCommand = new AddNewsCommand($news);
            $this->get('command_bus')->handle($addNewsCommand);


            $this->addFlash(
                'success',
                'Wiadomość została zapisana.'
            );

            return $this->redirectToRoute('kardi_admin_edit_news', ['id' => $news->getId()]);
        }


        return $this->render('KardiNewsBundle:Admin/News:add_news.html.twig', ['form' => $form->createView(), 'news' => $news]);
    }

    public function editNewsAction(int $id, Request $request)
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
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($news);
            $em->flush();

            $this->addFlash(
                'success',
                'Wiadomość została zapisana.'
            );

            return $this->redirectToRoute('kardi_admin_news');
        }


        return $this->render('KardiNewsBundle:Admin/News:edit_news.html.twig', ['form' => $form->createView(), 'news' => $news, 'pageTitle' => $pageTitle]);
    }

    public function deleteNewsAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('KardiNewsBundle:News')
            ->find($id);

        if (!$news) {
            throw new \Exception('News nie istnieje');
        }

        $deleteNewsCommand = new DeleteNewsCommand($news);
        $this->get('command_bus')->handle($deleteNewsCommand);

        return $this->redirect($this->generateUrl('kardi_admin_news'));
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
        $em->flush();

        return $this->redirectToRoute('kardi_admin_news');
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
        $em->flush();

        return $this->redirectToRoute('kardi_admin_news');
    }
}
