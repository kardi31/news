<?php

namespace Kardi\NewsBundle\Command\Handler;


use Doctrine\ORM\EntityManager;
use Kardi\FrameworkBundle\Helper\Text;
use Kardi\NewsBundle\Command\EditCategoryCommand;

class EditCategoryCommandHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em){

        $this->em = $em;
    }

    public function handle(EditCategoryCommand $command)
    {
        $category = $command->getCategory();

        foreach ($category->getTranslations() as $translation) {
            $translation->setSlug(Text::createSlug($translation->getTitle()));
        }

        $this->em->persist($category);
        $this->em->flush();
    }
}
