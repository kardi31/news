<?php

namespace Kardi\NewsBundle\Controller\Admin;

use Kardi\NewsBundle\Command\AddCategoryCommand;
use Kardi\NewsBundle\Form\Type\Admin\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function listCategoryAction(Request $request)
    {
        return $this->render('KardiNewsBundle:Admin/Category:list_category.html.twig');
    }

    public function listCategoryDataAction(Request $request)
    {
        $fields = [
            'c.id', 'ct.title', 'c.active'
        ];

        $data = $_GET;
        $em = $this->getDoctrine()->getManager();

        $categoryRepository = $em->getRepository('KardiNewsBundle:Category');
        $categoryList = $categoryRepository->getDatatableResults($fields, $data, null, $request->getLocale());
        $countNewsList = $categoryRepository->countDatatableResults($fields, $data, null, $request->getLocale());
        $rows = [];
        foreach ($categoryList as $categoryListRow) {
            $category = $categoryListRow[0];
            $row = [];

            $row[] = $category->getId();
            $row[] = $category->trans('title');
            $row[] = $this->get('kardi_admin.helper.datatable')->displayToggle($category->getActive(), 'kardi_admin_category_toggle_active', $category->getId());


            $options = $this->get('kardi_admin.helper.datatable')->displayLink('kardi_admin_edit_category', $category->getId(), 'edit');

            $row[] = $options;
            $rows[] = $row;
        }

        return new JsonResponse([
            'data' => $rows,
            'recordsFiltered' => $countNewsList,
            'recordsTotal' => count($rows),
        ]);
    }

    public function addCategoryAction(Request $request)
    {
        $category = $this->get('kardi_news.service.category')->createEmptyCategoryWithTranslations();

        $form = $this->createForm(Category::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $addCategoryCommand = new AddCategoryCommand($category);
            $this->get('command_bus')->handle($addCategoryCommand);


            $this->addFlash(
                'success',
                'Kategoria została zapisana.'
            );

            return $this->redirectToRoute('kardi_admin_edit_category', ['id' => $category->getId()]);
        }


        return $this->render('KardiNewsBundle:Admin/Category:add_category.html.twig', ['form' => $form->createView(), 'category' => $category]);
    }

    public function editCategoryAction(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('KardiNewsBundle:Category')
            ->find($id);

        if (!$category) {
            throw new \Exception('Kategoria nie istnieje');
        }
        $pageTitle = sprintf('Edytuj kategorię %s', $category->trans('title'));

        $form = $this->createForm(Category::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'success',
                'Kategoria została zapisana.'
            );

            return $this->redirectToRoute('kardi_admin_news_category');
        }


        return $this->render('KardiNewsBundle:Admin/Category:edit_category.html.twig', ['form' => $form->createView(), 'category' => $category, 'pageTitle' => $pageTitle]);
    }

    public function toggleActiveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('KardiNewsBundle:Category')
            ->find($id);

        if (!$category) {
            throw new \Exception('Kategoria nie istnieje');
        }

        $category->setActive(!$category->getActive());
        $em->persist($category);
        $em->flush();

        return $this->redirectToRoute('kardi_admin_news_category');
    }
}
