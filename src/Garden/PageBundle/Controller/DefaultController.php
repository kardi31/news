<?php

namespace Garden\PageBundle\Controller;

use Kardi\FrameworkBundle\Form\Type\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GardenPageBundle:Default:index.html.twig');
    }

    public function aboutUsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pageRepository = $em->getRepository('KardiPageBundle:Page');
        $aboutUs = $pageRepository->getPageByType('about-us');
        if (!$aboutUs) {
            throw new \Exception('About us page not found');
        }

        $aboutUs2 = $pageRepository->getPageByType('about-us2');
        if (!$aboutUs2) {
            throw new \Exception('About us page header not found');
        }

        return $this->render('GardenPageBundle:Default:about_us.html.twig', [
            'page' => $aboutUs,
            'page2' => $aboutUs2
        ]);
    }

    public function contactAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $pageRepository = $em->getRepository('KardiPageBundle:Page');
        $contact = $pageRepository->getPageByType('contact');
        if (!$contact) {
            throw new \Exception('Contact page not found');
        }

        $form = $this->createForm(Contact::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            dump('formvalid');exit;
        }

        return $this->render('GardenPageBundle:Default:contact.html.twig', [
            'page' => $contact,
            'form' => $form->createView()
        ]);
    }
}
