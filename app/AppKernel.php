<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new AppBundle\AppBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Wbc\AdministratorBundle\WbcAdministratorBundle(),
            new Wbc\FrontendBundle\WbcFrontendBundle(),
            new Wbc\ThemeBundle\WbcThemeBundle(),
            new Wbc\ServicesBundle\WbcServicesBundle(),
            new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Wbc\APIBundle\WbcAPIBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new Lexik\Bundle\TranslationBundle\LexikTranslationBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new Lexik\Bundle\CurrencyBundle\LexikCurrencyBundle(),
            new FOS\OAuthServerBundle\FOSOAuthServerBundle(),
            new Wbc\AuthBundle\WbcAuthBundle(),
            new Vresh\TwilioBundle\VreshTwilioBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
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

    public function __construct($environment, $debug)
    {
        ini_set('memory_limit', '900M');
        set_time_limit(0);
        date_default_timezone_set( 'America/Guatemala' );
        ini_set('xdebug.max_nesting_level', 500);
        parent::__construct($environment, $debug);
    }
}
