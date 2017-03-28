<?php

namespace Kardi\NewsletterBundle\Controller;

use Kardi\NewsletterBundle\Entity\Subscriber;
use Kardi\NewsletterBundle\Form\Type\Subscribe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function subscribeBoxAction(Request $request)
    {
        $form = $this->createForm(Subscribe::class);

        return $this->render('KardiNewsletterBundle:Default:subscribe_box.html.twig', ['form' => $form->createView()]);
    }

    public function subscribeAction(Request $request)
    {
        $form = $this->createForm(Subscribe::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $subscriber = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $subscriberExists = $em->getRepository(Subscriber::class)->findOneBy(
                [
                    'email' => $subscriber->getEmail(),
                ]
            );

            if ($subscriberExists) {
                if ($subscriberExists->getUnsubscribed()) {
                    $subscriberExists->setUnsubscribed(0);
                    $em->persist($subscriberExists);
                    $em->flush();

                    $this->addFlash(
                        'subscribe.success',
                        'subscribe.success'
                    );
                }
                else{
                    $this->addFlash(
                        'subscribe.error',
                        'subscribe.exists'
                    );
                }

                return $this->redirect('/');
            }

            $locale = $request->getLocale();
            $subscriber->setLocale($locale);

            $em->persist($subscriber);
            $em->flush();

            $this->addFlash(
                'newsletter',
                'subscribe.success'
            );

            return $this->redirect('/');
        }

        $this->addFlash(
            'newsletter.error',
            'subscribe.invalid.data'
        );

        return $this->redirect('/');

    }
}
