<?php

namespace Kardi\MediaBundle\Subscriber;

use Kardi\MediaBundle\Event\MediaEvents;
use Kardi\MediaBundle\Event\PrePhotoEditEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PrePhotoEditSubscriber implements EventSubscriberInterface
{
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var array
     */
    private $photoParam;

    public function __construct(RequestStack $requestStack, $photoParam = [])
    {
        $this->requestStack = $requestStack;
        $this->photoParam = $photoParam;
    }

    public function setReturnUrl(PrePhotoEditEvent $event)
    {
        if (!$this->requestStack->getMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $request = $this->requestStack->getMasterRequest();

        $request->getSession()->set('_returnUrl', $request->getRequestUri());
    }

    public function setPhotoSizes(PrePhotoEditEvent $event)
    {
        if (!$this->requestStack->getMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $request = $this->requestStack->getMasterRequest();
        $photoSizes = $this->photoParam[$event->getParamName()];

        $request->getSession()->set('_photoSizes', $photoSizes);
    }

    public static function getSubscribedEvents()
    {
        return [
            MediaEvents::PRE_PHOTO_EDIT => ['setReturnUrl', 0],
            MediaEvents::PRE_PHOTO_EDIT => ['setPhotoSizes', 0],
        ];
    }
}
