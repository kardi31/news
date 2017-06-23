<?php

namespace Kardi\PageBundle\Controller\Admin;

use Kardi\MediaBundle\Event\MediaEvents;
use Kardi\MediaBundle\Event\PrePhotoEditEvent;
use Kardi\PageBundle\Form\Type\Admin\Page;
use Kardi\PageBundle\Command\AddPageCommand;
use Kardi\PageBundle\Command\DeletePageCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function listPageAction()
    {
        return $this->render('KardiPageBundle:Admin:list_page.html.twig');
    }

    public function listPageDataAction(Request $request)
    {
        $fields = [
            'p.id', '', 'pt.title', 'p.updatedAt'
        ];

        $data = $_GET;
        $em = $this->getDoctrine()->getManager();

        $pageRepository = $em->getRepository('KardiPageBundle:Page');
        $pageList = $pageRepository->getDatatableResults($fields, $data, null, $request->getLocale());
        $countPageList = $pageRepository->countDatatableResults($fields, $data, null, $request->getLocale());
        $rows = [];
        foreach ($pageList as $page) {
            $row = [];

            $row[] = $page->getId();

            $row[] = sprintf('<img src="%s" />', $page->getPhoto()->getMainPhoto()->show('126x126'));
            $row[] = $page->trans('title');
            $row[] = $page->getUpdatedAt()->format('d/m/Y H:i');

            $options = $this->get('kardi_admin.helper.datatable')->displayLink('kardi_admin_edit_page', $page->getId(), 'edit');

            $row[] = $options;
            $rows[] = $row;
        }

        return new JsonResponse([
            'data' => $rows,
            'recordsFiltered' => $countPageList,
            'recordsTotal' => count($rows),
        ]);
    }

    public function addPageAction(Request $request)
    {
        $page = $this->get('kardi_page.service.page')->createEmptyPageWithTranslations();

        $form = $this->createForm(Page::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $addPageCommand = new AddPageCommand($page);
            $this->get('command_bus')->handle($addPageCommand);


            $this->addFlash(
                'success',
                'Strona została zapisana.'
            );

            return $this->redirectToRoute('kardi_admin_edit_page', ['id' => $page->getId()]);
        }


        return $this->render('KardiPageBundle:Admin:add_page.html.twig', ['form' => $form->createView(), 'page' => $page]);
    }

    public function editPageAction(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('KardiPageBundle:Page')
            ->find($id);

        if (!$page) {
            throw new \Exception('Strona nie istnieje');
        }
        $pageTitle = sprintf('Edytuj strone %s', $page->trans('title'));

        $this->get('event_dispatcher')->dispatch(MediaEvents::PRE_PHOTO_EDIT, new PrePhotoEditEvent('kardipagebundle_page', $pageTitle));

        $form = $this->createForm(Page::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($page);
            $em->flush();

            $this->addFlash(
                'success',
                'Strona została zapisana.'
            );

            return $this->redirectToRoute('kardi_admin_page');
        }


        return $this->render('KardiPageBundle:Admin:edit_page.html.twig', ['form' => $form->createView(), 'page' => $page, 'pageTitle' => $pageTitle]);
    }

    public function deletePageAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('KardiPageBundle:Page')
            ->find($id);

        if (!$page) {
            throw new \Exception('Strona nie istnieje');
        }

        $deletePageCommand = new DeletePageCommand($page);
        $this->get('command_bus')->handle($deletePageCommand);

        return $this->redirect($this->generateUrl('kardi_admin_page'));
    }

    public function toggleActiveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('KardiPageBundle:Page')
            ->find($id);

        if (!$page) {
            throw new \Exception('Page nie istnieje');
        }

        $page->setActive(!$page->getActive());
        $em->persist($page);
        $em->flush();

        return $this->redirectToRoute('kardi_admin_page');
    }


    public function toggleBreakingAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('KardiPageBundle:Page')
            ->find($id);

        if (!$page) {
            throw new \Exception('Page nie istnieje');
        }

        $page->setActive(!$page->getActive());
        $em->persist($page);
        $em->flush();

        return $this->redirectToRoute('kardi_admin_page');
    }
}
