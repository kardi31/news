<?php

namespace Kardi\NewsBundle\Twig;

class CommentExtension extends \Twig_Extension
{
    /**
     * @var @service_container
     */
    private $_container;

    /**
     * CommentExtension constructor.
     * @param @service_container $container
     */
    public function __construct($container)
    {
        $this->_container = $container;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'comments_active',
                [$this, 'commentsActive']
            ),
        ];
    }

    public function commentsActive()
    {
        $param = false;
        if ($this->_container->hasParameter('comments_active'))
            $param = $this->_container->getParameter('comments_active');

        return $param;
    }

}
