<?php

namespace Kardi\NewsBundle\Controller\Admin;

use Kardi\NewsBundle\Command\AddTagCommand;
use Kardi\NewsBundle\Command\DeleteTagCommand;
use Kardi\NewsBundle\Form\Type\Admin\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
    public function listTagAction(Request $request)
    {
        return $this->render('KardiNewsBundle:Admin/Tag:list_tag.html.twig');
    }

    public function listTagDataAction(Request $request)
    {
        $fields = [
            't.id', 'tt.title'
        ];

        $data = $_GET;
        $em = $this->getDoctrine()->getManager();

        $tagRepository = $em->getRepository('KardiNewsBundle:Tag');
        $tagList = $tagRepository->getDatatableResults($fields, $data, null, $request->getLocale());
        $countTagList = $tagRepository->countDatatableResults($fields, $data, null, $request->getLocale());
        $rows = [];
        foreach ($tagList as $tag) {
            $row = [];

            $row[] = $tag->getId();
            $row[] = $tag->trans('title');

            $options = $this->get('kardi_admin.helper.datatable')->displayLink('kardi_admin_edit_news_tag', $tag->getId(), 'edit');
            $options .= ' ' . $this->get('kardi_admin.helper.datatable')->displayLink('kardi_admin_delete_news_tag', $tag->getId(), 'times', 'delete');

            $row[] = $options;
            $rows[] = $row;
        }

        return new JsonResponse([
            'data' => $rows,
            'recordsFiltered' => $countTagList,
            'recordsTotal' => count($rows),
        ]);
    }

    public function addTagAction(Request $request)
    {
        $tag = $this->get('kardi_news.service.tag')->createEmptyTagWithTranslations();

        $form = $this->createForm(Tag::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addTagCommand = new AddTagCommand($tag);
            $this->get('command_bus')->handle($addTagCommand);


            $this->addFlash(
                'success',
                'Tag został zapisany.'
            );

            return $this->redirectToRoute('kardi_admin_news_tag', ['id' => $tag->getId()]);
        }


        return $this->render('KardiNewsBundle:Admin/Tag:add_tag.html.twig', ['form' => $form->createView(), 'tag' => $tag]);
    }

    public function editTagAction(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('KardiNewsBundle:Tag')
            ->find($id);

        if (!$tag) {
            throw new \Exception('Tag nie istnieje');
        }
        $pageTitle = sprintf('Edytuj tag %s', $tag->trans('title'));

        $form = $this->createForm(Tag::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tag);
            $em->flush();

            $this->addFlash(
                'success',
                'Tag został zapisany.'
            );

            return $this->redirectToRoute('kardi_admin_news_tag');
        }


        return $this->render('KardiNewsBundle:Admin/Tag:edit_tag.html.twig', ['form' => $form->createView(), 'tag' => $tag, 'pageTitle' => $pageTitle]);
    }

    public function deleteTagAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('KardiNewsBundle:Tag')
            ->find($id);

        if (!$tag) {
            throw new \Exception('Tag nie istnieje');
        }

        $deleteTagCommand = new DeleteTagCommand($tag);
        $this->get('command_bus')->handle($deleteTagCommand);

        return $this->redirect($this->generateUrl('kardi_admin_news_tag'));
    }
}
