<?php

namespace Kardi\NewsBundle\Command;

use Kardi\NewsBundle\Entity\Tag;

class AddTagCommand
{
    /**
     * @var Tag
     */
    private $tag;

    public function __construct(Tag $tag){

        $this->tag = $tag;
    }

    /**
     * @return Tag
     */
    public function getTag(): Tag
    {
        return $this->tag;
    }
}
