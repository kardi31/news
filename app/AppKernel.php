<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
//        die('beforedep');
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Kardi\LayoutBundle\KardiLayoutBundle(),
            new Kardi\MenuBundle\KardiMenuBundle(),
            new Emigrant\LayoutBundle\EmigrantLayoutBundle(),
            new Kardi\PageBundle\KardiPageBundle(),
            new Kardi\BannerBundle\KardiBannerBundle(),
            new Kardi\NewsBundle\KardiNewsBundle(),
            new Kardi\FrameworkBundle\KardiFrameworkBundle(),
            new BeSimple\I18nRoutingBundle\BeSimpleI18nRoutingBundle(),
            new Emigrant\NewsBundle\EmigrantNewsBundle(),
            new Emigrant\BannerBundle\EmigrantBannerBundle(),
            new Kardi\NewsletterBundle\KardiNewsletterBundle(),
            new Kardi\GalleryBundle\KardiGalleryBundle(),
            new Kardi\MediaBundle\KardiMediaBundle(),
            new Kardi\AdBundle\KardiAdBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Kardi\SeoBundle\KardiSeoBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Emigrant\AdBundle\EmigrantAdBundle(),
            new Kardi\AdminBundle\KardiAdminBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
