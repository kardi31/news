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

        $contactEmail = $this->container->getParameter('contact_email');

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();

            $contactEmail = $this->container->getParameter('contact_email');
            $mailerFrom = $this->container->getParameter('mailer_user');

            $mailer = $this->container->get('mailer');
            $message = (new \Swift_Message('Wiadomość kontaktowa ze strony'))
                ->setFrom($mailerFrom)
                ->setTo($contactEmail)
                ->setReplyTo($contact->getEmail(), $contact->getName())
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        [
                            'message' => $contact->getMessage(),
                            'name' => $contact->getName(),
                            'email' => $contact->getEmail()
                        ]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash(
                'contact.success',
                'Dziękujemy za wiadomość. Skontaktujemy się z Tobą wkrótce'
            );

            return $this->redirectToRoute('kardi_page_contact');
        }

        return $this->render('GardenPageBundle:Default:contact.html.twig', [
            'page' => $contact,
            'form' => $form->createView()
        ]);
    }
}
