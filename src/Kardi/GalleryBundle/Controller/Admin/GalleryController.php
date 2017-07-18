<?php

namespace Kardi\GalleryBundle\Controller\Admin;

use Kardi\GalleryBundle\Command\AddGalleryCommand;
use Kardi\MediaBundle\Event\MediaEvents;
use Kardi\MediaBundle\Event\PrePhotoEditEvent;
use Kardi\GalleryBundle\Command\DeleteGalleryCommand;
use Kardi\GalleryBundle\Form\Type\Admin\Gallery;
use Kardi\GalleryBundle\Entity\Gallery as GalleryEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{
    public function listGalleryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $request->getLocale();

        $categoryNames = $em->getRepository('KardiGalleryBundle:Category')->getCategoryNames($locale);

        return $this->render('KardiGalleryBundle:Admin/Gallery:list_gallery.html.twig', ['categoryNames' => $categoryNames]);
    }

    public function listGalleryDataAction(Request $request)
    {
        $fields = [
            'c.id', '', 'ct.title', 'c.active', 'cat.id ', 'c.createdAt', 'c.publishDate'
        ];

        $data = $_GET;
        $em = $this->getDoctrine()->getManager();

        $galleryRepository = $em->getRepository('KardiGalleryBundle:Gallery');
        $galleryList = $galleryRepository->getDatatableResults($fields, $data, null, $request->getLocale());
        $countGalleryList = $galleryRepository->countDatatableResults($fields, $data, null, $request->getLocale());
        $rows = [];
        foreach ($galleryList as $gallery) {
            $row = [];

            $row[] = $gallery->getId();

            $row[] = sprintf('<img src="%s" />', $gallery->getPhoto()->getMainPhoto()->show('126x126'));
            $row[] = $gallery->trans('title');
            $row[] = $this->get('kardi_admin.helper.datatable')->displayToggle($gallery->getActive(), 'kardi_admin_gallery_toggle_active', $gallery->getId());
            $row[] = $gallery->getCategory()->trans('title');
            $row[] = $gallery->getCreatedAt()->format('d/m/Y H:i');
            $row[] = $gallery->getPublishDate()->format('d/m/Y H:i');

            $options = $this->get('kardi_admin.helper.datatable')->displayLink('kardi_admin_edit_gallery', $gallery->getId(), 'edit');
            $options .= ' ' . $this->get('kardi_admin.helper.datatable')->displayLink('kardi_admin_delete_gallery', $gallery->getId(), 'times', 'delete');

            $row[] = $options;
            $rows[] = $row;
        }

        return new JsonResponse([
            'data' => $rows,
            'recordsFiltered' => $countGalleryList,
            'recordsTotal' => count($rows),
        ]);
    }

    public function addGalleryAction(Request $request)
    {
        $gallery = $this->get('kardi_gallery.service.gallery')->createEmptyGalleryWithTranslations();

        $form = $this->createForm(Gallery::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $addGalleryCommand = new AddGalleryCommand($gallery);
            $this->get('command_bus')->handle($addGalleryCommand);


            $this->addFlash(
                'success',
                'Galeria została zapisana.'
            );

            return $this->redirectToRoute('kardi_admin_edit_gallery', ['id' => $gallery->getId()]);
        }


        return $this->render('KardiGalleryBundle:Admin/Gallery:add_gallery.html.twig', ['form' => $form->createView(), 'gallery' => $gallery]);
    }

    public function editGalleryAction(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('KardiGalleryBundle:Gallery')
            ->find($id);

        if (!$gallery) {
            throw new \Exception('Galleria nie istnieje');
        }
        $pageTitle = sprintf('Edytuj galerie %s', $gallery->trans('title'));

        $this->get('event_dispatcher')->dispatch(MediaEvents::PRE_PHOTO_EDIT, new PrePhotoEditEvent('kardigallerybundle_gallery', $pageTitle));

        $form = $this->createForm(Gallery::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($gallery);
            $em->flush();

            $this->addFlash(
                'success',
                'Galeria została zapisana.'
            );

            return $this->redirectToRoute('kardi_admin_gallery');
        }


        return $this->render('KardiGalleryBundle:Admin/Gallery:edit_gallery.html.twig', ['form' => $form->createView(), 'gallery' => $gallery, 'pageTitle' => $pageTitle]);
    }

    public function deleteGalleryAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('KardiGalleryBundle:Gallery')
            ->find($id);

        if (!$gallery) {
            throw new \Exception('Gallery nie istnieje');
        }

        $deleteGalleryCommand = new DeleteGalleryCommand($gallery);
        $this->get('command_bus')->handle($deleteGalleryCommand);

        return $this->redirect($this->generateUrl('kardi_admin_gallery'));
    }

    public function toggleActiveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('KardiGalleryBundle:Gallery')
            ->find($id);

        if (!$gallery) {
            throw new \Exception('Gallery nie istnieje');
        }

        $gallery->setActive(!$gallery->getActive());
        $em->persist($gallery);
        $em->flush();

        return $this->redirectToRoute('kardi_admin_gallery');
    }


    public function toggleBreakingAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('KardiGalleryBundle:Gallery')
            ->find($id);

        if (!$gallery) {
            throw new \Exception('Gallery nie istnieje');
        }

        $gallery->setActive(!$gallery->getActive());
        $em->persist($gallery);
        $em->flush();

        return $this->redirectToRoute('kardi_admin_gallery');
    }
}
