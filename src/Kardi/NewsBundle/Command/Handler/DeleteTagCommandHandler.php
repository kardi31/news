<?php

namespace Kardi\NewsBundle\Command\Handler;


use Doctrine\ORM\EntityManager;
use Kardi\NewsBundle\Command\DeleteTagCommand;

class DeleteTagCommandHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em){

        $this->em = $em;
    }

    public function handle(DeleteTagCommand $command)
    {
        $tag = $command->getTag();

        foreach($tag->getTranslations() as $translation){
            $this->em->remove($translation);
        }

        $tag->getNews()->clear();

        $this->em->remove($tag);
        $this->em->flush();
    }
}
