<?php

namespace Kardi\NewsBundle\Command\Handler;


use Doctrine\ORM\EntityManager;
use Kardi\FrameworkBundle\Helper\Text;
use Kardi\NewsBundle\Command\AddCategoryCommand;

class AddCategoryCommandHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em){

        $this->em = $em;
    }

    public function handle(AddCategoryCommand $command)
    {
        $category = $command->getCategory();

        foreach ($category->getTranslations() as $translation) {
            $translation->setSlug(Text::createSlug($translation->getTitle()));
        }

        $this->em->persist($category);
        $this->em->flush();
    }
}
