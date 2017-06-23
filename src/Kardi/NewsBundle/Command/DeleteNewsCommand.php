<?php

namespace Kardi\NewsBundle\Command;

use Kardi\NewsBundle\Entity\News;

class DeleteNewsCommand
{
    /**
     * @var News
     */
    private $news;

    public function __construct(News $news){

        $this->news = $news;
    }

    /**
     * @return News
     */
    public function getNews(): News
    {
        return $this->news;
    }
}
