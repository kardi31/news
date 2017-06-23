<?php

namespace Kardi\MenuBundle\Controller\Admin;

use Kardi\MenuBundle\Form\MenuItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function listMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $menuList = $em->getRepository('KardiMenuBundle:Menu')
            ->findAll();

        return $this->render('KardiMenuBundle:Admin:list_menu.html.twig', ['menuList' => $menuList]);
    }

    public function moveMenuItemAction(Request $request)
    {
        $newTree = $request->request->get('newTree');
        $em = $this->getDoctrine()->getManager();

        foreach ($newTree as $key => $elem) {
            $this->positionMenuItem($elem, $key);
        }

        $em->flush();

        return new Response('success');
    }

    private function positionMenuItem($arrayItem, $key, $parent = null)
    {
        $em = $this->getDoctrine()->getManager();
        $treeRepo = $em->getRepository('KardiMenuBundle:MenuItem');
        $treeItem = $treeRepo->find($arrayItem['id']);
        if (!$treeItem) {
            return;
        }

        $treeItem->setPos($key);
        if ($parent) {
            $treeItem->setParent($parent->getId());
        } else {
            $treeItem->setParent(null);
        }

        $em->persist($treeItem);

        if (!empty($arrayItem['children'])) {
            foreach ($arrayItem['children'] as $childKey => $child) {
                $this->positionMenuItem($child, $childKey, $treeItem);
            }
        }
    }

    public function showMenuAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('KardiMenuBundle:Menu')
            ->find($id);

        return $this->render('KardiMenuBundle:Admin:show_menu.html.twig', ['menu' => $menu]);
    }

    public function showMenuDataAction()
    {
        $em = $this->getDoctrine()->getManager();
        $treeRepo = $em->getRepository('KardiMenuBundle:MenuItem');

        $menuTree = $treeRepo->fetchMenuTree(28);

        $data = [];
        foreach ($menuTree as $id => $menuItem) {
            $data[$id] = $this->prepareLineItem($menuItem);
        }

        return new JsonResponse(array_values($data));
    }

    private function prepareLineItem($treeItem, $parent = null)
    {
        $data = [];
        $data['id'] = $treeItem->getId();
        $data['icon'] = "fa fa-folder icon-lg icon-state-default";
        $data['text'] = $treeItem->trans('title');
        $data['a_attr']['href'] = $this->generateUrl('kardi_admin_menu_edit_item', ['id' => $treeItem->getId()]);
        if ($parent) {
            $data['parent'] = $parent->getId();
        }

        if (!empty($treeItem->getChildren())) {
            $data['children'] = true;
            $data['type'] = 'root';
            $data['children'] = [];
            foreach ($treeItem->getChildren() as $child) {
                $data['children'][] = $this->prepareLineItem($child, $treeItem);
            }
        }
        return $data;
    }

    public function editMenuItemAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('KardiMenuBundle:MenuItem')
            ->find($id);

        if (!$menu) {
            throw new \Exception('Element nie istnieje');
        }

        $form = $this->createForm(MenuItem::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($menu);
            $em->flush();

            $this->addFlash(
                'success',
                'Element menu został zapisany.'
            );

            return $this->redirectToRoute('kardi_admin_menu_show', ['id' => $menu->getMenuId()]);
        }


        return $this->render('@KardiMenu/Admin/edit_menu_item.html.twig', ['form' => $form->createView(), 'menuItem' => $menu]);

    }


    public function deleteMenuItemAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('KardiMenuBundle:MenuItem')
            ->find($id);

        if (!$menu) {
            throw new \Exception('Element nie istnieje');
        }

        foreach ($menu->getTranslations() as $translation) {
            $em->remove($translation);
        }
        $em->remove($menu);
        $em->flush();

        $this->addFlash(
            'success',
            'Element menu został usunięty.'
        );

        return $this->redirectToRoute('kardi_admin_menu_show', ['id' => $menu->getMenuId()]);


    }
}
