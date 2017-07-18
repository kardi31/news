<?php

namespace Kardi\GalleryBundle\Command\Handler;

use Doctrine\ORM\EntityManager;
use Kardi\FrameworkBundle\Helper\Text;
use Kardi\MediaBundle\Entity\Photo;
use Kardi\GalleryBundle\Command\AddGalleryCommand;
use Kardi\GalleryBundle\Repository\CategoryRepository;

class AddGalleryCommandHandler
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

    public function handle(AddGalleryCommand $command)
    {
        $gallery = $command->getGallery();
        $category = $this->em->getRepository('KardiGalleryBundle:Category')
            ->find($gallery->getCategoryId());

        $photoRoot = new Photo();

        $treeRepository = $this->em->getRepository('KardiMediaBundle:Photo');
        $treeRepository->persistAsLastChild($photoRoot);
        $gallery->setPhoto($photoRoot);
        if ($category) {
            $gallery->setCategory($category);
        }

        foreach ($gallery->getTranslations() as $translation) {
            $translation->setSlug(Text::createSlug($translation->getTitle()));
        }

        $this->em->persist($gallery);
        $this->em->flush();
    }
}
