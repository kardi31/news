<?php

namespace Kardi\NewsBundle\Command\Handler;


use Doctrine\ORM\EntityManager;
use Kardi\FrameworkBundle\Helper\Text;
use Kardi\MediaBundle\Entity\Photo;
use Kardi\NewsBundle\Command\AddNewsCommand;
use Kardi\NewsBundle\Command\DeleteNewsCommand;
use Kardi\NewsBundle\Repository\CategoryRepository;

class AddNewsCommandHandler
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(EntityManager $em, CategoryRepository $categoryRepository){

        $this->em = $em;
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(AddNewsCommand $command)
    {
        $news = $command->getNews();

        $category = $this->em->getRepository('KardiNewsBundle:Category')
            ->find($news->getCategoryId());

        $photoRoot = new Photo();

        $treeRepository = $this->em->getRepository('KardiMediaBundle:Photo');
        $treeRepository->persistAsLastChild($photoRoot);
        $news->setPhoto($photoRoot);
        if ($category) {
            $news->setCategory($category);
        }

        foreach ($news->getTranslations() as $translation) {
            $translation->setSlug(Text::createSlug($translation->getTitle()));
        }

        $this->em->persist($news);
        $this->em->flush();
    }
}
