<?php

namespace Kardi\PageBundle\Command\Handler;

use Doctrine\ORM\EntityManager;
use Kardi\FrameworkBundle\Helper\Text;
use Kardi\MediaBundle\Entity\Photo;
use Kardi\PageBundle\Command\AddPageCommand;

class AddPageCommandHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em){

        $this->em = $em;
    }

    public function handle(AddPageCommand $command)
    {
        $page = $command->getPage();

        $photoRoot = new Photo();

        $treeRepository = $this->em->getRepository('KardiMediaBundle:Photo');
        $treeRepository->persistAsLastChild($photoRoot);
        $page->setPhoto($photoRoot);

        foreach ($page->getTranslations() as $translation) {
            $translation->setSlug(Text::createSlug($translation->getTitle()));
        }

        $this->em->persist($page);
        $this->em->flush();
    }
}
