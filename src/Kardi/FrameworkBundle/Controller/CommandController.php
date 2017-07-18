<?php

namespace Kardi\FrameworkBundle\Controller;

use Doctrine\Bundle\DoctrineBundle\Command\GenerateEntitiesDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\InfoDoctrineCommand;

use Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand;
use Symfony\Bundle\FrameworkBundle\Command\CacheClearCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CommandController extends Controller
{
    public function mappingInfoAction()
    {

        $command = new InfoDoctrineCommand();
        $command->setApplication(new Application($this->container->get('kernel')));
//        $command->setContainer($this->container);
        $input = new ArrayInput([]);
        $output = new BufferedOutput();
        $resultCode = $command->run($input, $output);

        return new Response($output->fetch());
    }

    public function generateEntityAction()
    {

        $command = new GenerateEntitiesDoctrineCommand();
        $command->setApplication(new Application($this->container->get('kernel')));
//        $command->setContainer($this->container);
        $input = new ArrayInput(array('name' => 'KardiMediaBundle'));
        $output = new BufferedOutput();
        $resultCode = $command->run($input, $output);

        return new Response($output->fetch());
    }

    public function cacheClearAction()
    {
//        dump($this->getApplication());exit;
        $command = new CacheClearCommand();

//        $command->setApplication(new Application($this->container->get('kernel')));
        $command->setContainer($this->container);
        $staticEnvMode = 'prod'; // to use production mode
        $input = new ArgvInput(array('--env=' . $staticEnvMode ));
        $output = new BufferedOutput();
        $resultCode = $command->run($input, $output);

        return new Response($output->fetch());
    }
}
