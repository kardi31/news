<?php
namespace Kardi\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Kardi\NewsBundle\Entity\Comment;

class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $lastNewsId = 0;
        for ($j = 0; $j <= 20; $j++) {
            $comment = new Comment();
            // random if breaking or not
            $comment->setAuthor('John Doe '.$j);
            $comment->setIp('11:11:222:333');
            $comment->setHostname('sky.net');
            $comment->setActive(1);
            $comment->setContent(str_repeat('This is a test comment '.$j.' ', 5));
            $comment->setEmail('email'.$j.'@email.pl');

            $randNews = rand(0, 10);
            $comment->setNews($em->merge($this->getReference('news'.$randNews)));

            $treeRepository = $em->getRepository(Comment::class);
            $treeRepository->persistAsFirstChild($comment);

            $lastNewsId = $randNews;

            $em->persist($comment);

            $em->flush();
        }

        for ($i = 0; $i <= 3; $i++) {
            $comment2 = new Comment();
            // random if breaking or not
            $comment2->setAuthor('John Doe '.$j);
            $comment2->setIp('11:11:222:333');
            $comment2->setHostname('sky.net');
            $comment2->setActive(1);
            $comment2->setContent(str_repeat('This is a test comment '.$j.' - '.$i.' ', 5));
            $comment2->setEmail('email'.$j.'-'.$i.'@email.pl');

            $comment2->setNews($em->merge($this->getReference('news'.$lastNewsId)));

            $treeRepository = $em->getRepository(Comment::class);
            $treeRepository->persistAsLastChildOf($comment2, $comment);

            $em->persist($comment2);

            $em->flush();
        }

    }

    public function getOrder()
    {
        return 13; // the order in which fixtures will be loaded
    }
}

?>
