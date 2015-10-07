<?php

namespace eig\Imaginator\Factory;

use eig\Configurator\Options as ConfigOptions;
use eig\Configurator\Configurator as Config;
use eig\Imaginator\Exceptions\ImaginatorException;
use eig\Imaginator\Imaginator;

class ImaginatorFactory
{
    protected static $configFiles = [
        [
            'source'   => 'ImaginatorConfiguration.php',
            'path'     => 'config/',
            'pathType' => 'relative',
            'type'     => 'array',
            'alias'    => 'Imaginator'
        ],
    ];

    protected static $packageConfig;

    protected static $configOptions;

    protected static function loadConfiguration ()
    {
        // set the Configurator Options
        // including the basePath for where the configuration file exists
        self::$configOptions = new ConfigOptions();
        self::$configOptions->basePath = realpath('config');
        try
        {
            // try to load and Configurator Configuration for Imaginator
            self::$packageConfig = new Config(
                self::$configFiles,
                self::$configOptions
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

    protected static function packageConfig()
    {
        return self::$packageConfig;
    }

    protected static function getPersistenceProvider() {
        return  new self::$packageConfig['Imaginator']['Record Persistence Provider']();
    }

    protected static function getSpecifierPersistenceProvider() {
        return new self::$packageConfig['Imaginator']['Specifier Persistence Provider']();
    }

    public static function make()
    {
        self::loadConfiguration();
        return new Imaginator(self::packageConfig(), self::getPersistenceProvider(), self::getSpecifierPersistenceProvider());
    }
}