<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array_merge([
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
            new BeSimple\I18nRoutingBundle\BeSimpleI18nRoutingBundle(),
            new EWZ\Bundle\RecaptchaBundle\EWZRecaptchaBundle(),
            new \FOS\UserBundle\FOSUserBundle()
        ],
            $this->loadKardiBundles(),
//            $this->loadEmigrantBundles()
            $this->loadGardenBundles()

        );

//        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
//        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__) . '/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    private function loadEmigrantBundles()
    {
        return [
            new Emigrant\NewsBundle\EmigrantNewsBundle(),
            new Emigrant\BannerBundle\EmigrantBannerBundle(),
            new Emigrant\LayoutBundle\EmigrantLayoutBundle(),
            new Emigrant\AdBundle\EmigrantAdBundle(),
        ];
    }

    private function loadGardenBundles()
    {
        return [
            new Garden\LayoutBundle\GardenLayoutBundle(),
            new Garden\MenuBundle\GardenMenuBundle(),
            new Garden\NewsBundle\GardenNewsBundle(),
            new \Garden\PageBundle\GardenPageBundle(),
            new \Garden\GalleryBundle\GardenGalleryBundle()
        ];
    }

    private function loadKardiBundles()
    {
        return [
            new Kardi\LayoutBundle\KardiLayoutBundle(),
            new Kardi\MenuBundle\KardiMenuBundle(),
            new Kardi\PageBundle\KardiPageBundle(),
            new Kardi\BannerBundle\KardiBannerBundle(),
            new Kardi\NewsBundle\KardiNewsBundle(),
            new Kardi\FrameworkBundle\KardiFrameworkBundle(),
            new Kardi\SeoBundle\KardiSeoBundle(),
            new Kardi\NewsletterBundle\KardiNewsletterBundle(),
            new Kardi\GalleryBundle\KardiGalleryBundle(),
            new Kardi\MediaBundle\KardiMediaBundle(),
            new Kardi\AdBundle\KardiAdBundle(),
            new Kardi\AdminBundle\KardiAdminBundle(),
            new \Kardi\UserBundle\KardiUserBundle()
        ];
    }
}
