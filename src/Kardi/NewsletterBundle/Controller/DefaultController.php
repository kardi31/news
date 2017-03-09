<?php

namespace Kardi\NewsletterBundle\Controller;

use Kardi\NewsletterBundle\Form\Type\Subscribe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function subscribeBoxAction()
    {
        $form = $this->createForm(Subscribe::class);

        return $this->render('KardiNewsletterBundle:Default:subscribe_box.html.twig', ['form' => $form->createView()]);
    }

    public function subscribeAction(Request $request)
    {
        $form = $this->createForm(Subscribe::class);
        $form->handleRequest($request);
        $form->get('email')->addError(new FormError('error message'));
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            $this->addFlash(
                'newsletter',
                'subscribe.success'
            );

            return $this->redirect('/');
        }

        $this->addFlash(
            'newsletter',
            'Error!'
        );
        return $this->redirect('/');

    }
}
