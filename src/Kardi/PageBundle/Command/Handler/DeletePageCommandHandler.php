<?php

namespace Kardi\PageBundle\Command\Handler;


use Doctrine\ORM\EntityManager;
use Kardi\MediaBundle\Service\Photo;
use Kardi\PageBundle\Command\DeletePageCommand;

class DeletePageCommandHandler
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var Photo
     */
    private $photoService;

    public function __construct(EntityManager $em, Photo $photoService){

        $this->em = $em;
        $this->photoService = $photoService;
    }

    public function handle(DeletePageCommand $command)
    {
        $page = $command->getPage();

        $this->photoService->deletePhotosByRoot($page->getPhoto());

        foreach($page->getTranslations() as $translation){
            $this->em->remove($translation);
        }

        $this->em->remove($page);
        $this->em->flush();
    }
}
