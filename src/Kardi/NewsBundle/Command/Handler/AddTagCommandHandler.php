<?php

namespace Kardi\NewsBundle\Command\Handler;


use Doctrine\ORM\EntityManager;
use Kardi\FrameworkBundle\Helper\Text;
use Kardi\NewsBundle\Command\AddTagCommand;

class AddTagCommandHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em){

        $this->em = $em;
    }

    public function handle(AddTagCommand $command)
    {
        $tag = $command->getTag();

        foreach ($tag->getTranslations() as $translation) {
            $translation->setSlug(Text::createSlug($translation->getTitle()));
        }

        $this->em->persist($tag);
        $this->em->flush();
    }
}
