<?php

namespace Kardi\NewsBundle\Form\Type;

use BeSimple\I18nRoutingBundle\Routing\Router;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class Search extends AbstractType
{
    /**
     * @var Router
     */
    private $router;

    function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $constraints = $this->prepareConstraints();

        $builder->add('search', null, [
            'attr' => [
                'placeholder' => 'search.placeholder.name'
            ],
            'label' => false,
            'constraints' => $constraints
        ]);
        $builder->add('submit_search', SubmitType::class, ['attr' => ['class' => 'button' ], 'label' => false]);
        $builder->setMethod('GET');
        $builder->setAction($this->router->generate('kardi_news_search'));
    }

    private function prepareConstraints()
    {
        return [
            new Length(['min' => 3]),
            new Regex([
                'pattern' => '/^[a-zA-Z0-9]+([\w ]+)$/',
            ])
        ];
    }
}
