<?php

namespace Kardi\MenuBundle\Command\Handler;

use Doctrine\ORM\EntityManager;

class DeleteMenuItemCommandHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em){

        $this->em = $em;
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
