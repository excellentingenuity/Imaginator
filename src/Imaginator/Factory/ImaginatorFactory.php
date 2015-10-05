<?php

namespace eig\Imaginator\Factory;

use eig\Configurator\Options as ConfigOptions;
use eig\Configurator\Configurator as Config;
use eig\Imaginator\Exceptions\ImaginatorException;
use eig\Imaginator\Imaginator;

class ImaginatorFactory
{
    protected $configFiles = [
        [
            'source'   => 'ImaginatorConfiguration.php',
            'path'     => 'config/',
            'pathType' => 'relative',
            'type'     => 'array',
            'alias'    => 'Imaginator'
        ],
    ];

    protected $packageConfig;

    protected $configOptions;

    protected function loadConfiguration ()
    {
        // set the Configurator Options
        // including the basePath for where the configuration file exists
        $this->configOptions = new ConfigOptions();
        $this->configOptions->basePath = realpath('config');
        try
        {
            // try to load and Configurator Configuration for Imaginator
            $this->packageConfig = new Config(
                $this->configFiles,
                $this->configOptions
            );
        } catch (\Exception $exception)
        {
            throw new ImaginatorException(
                'Error: Unable to load Imaginator Configuration',
                1,
                $exception
            );
        }
    }

    protected function packageConfig()
    {
        return $this->packageConfig;
    }

    protected function getPersistenceProvider() {
        return $this->packageConfig['Imaginator']['Record Persistance Provider'];
    }

    public static function make()
    {
        self::loadConfiguration();
        return new Imaginator(self::packageConfig(), self::getPersistenceProvider());
    }
}