<?php

namespace Kardi\NewsBundle\Command\Handler;


use Doctrine\ORM\EntityManager;
use Kardi\MediaBundle\Service\Photo;
use Kardi\NewsBundle\Command\DeleteNewsCommand;

class DeleteNewsCommandHandler
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

    public function handle(DeleteNewsCommand $command)
    {
        $news = $command->getNews();

        $this->photoService->deletePhotosByRoot($news->getPhoto());

        foreach($news->getTranslations() as $translation){
            $this->em->remove($translation);
        }

        $news->getTags()->clear();

        foreach($news->getComments() as $comment){
            $this->em->remove($comment);
        }

        $this->em->remove($news);
        $this->em->flush();
    }
}
