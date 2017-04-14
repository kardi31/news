<?php

namespace Kardi\NewsBundle\Provider;

use Kardi\NewsBundle\Repository\TagRepository;

class TagProvider
{

    /**
     * @var TagRepository
     */
    protected $tagRepository;

    /**
     * TagProvider constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param bool $withEmptyOption
     * @return array
     */
    public function prependTags($withEmptyOption = true)
    {
        $result = $this->tagRepository->findAll();

      return $result;
    }
}
