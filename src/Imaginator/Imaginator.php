<?php

namespace eig\Imaginator;

use eig\Configurator\Configurator as Config;
use eig\Configurator\Options as ConfigOptions;
use eig\Imaginator\Exceptions\ImaginatorException;

class Imaginator
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

    protected $config;

    protected $packageConfig;

    protected $configOptions;

    public function __construct ()
    {

        $this->loadConfiguration ();

    }

    protected function loadConfiguration ()
    {
        // set the Configurator Options
        // including the basePath for where the configuration file exists
        $this->configOptions = new ConfigOptions();
        $this->configOptions->basePath = realpath('config');
        try
        {
            // try to load and Configurator Configuration for Imaginator
            $this->packageConfig = new Config($this->configFiles, $this->configOptions);
        } catch (\Exception $exception)
        {
            throw new ImaginatorException(
                'Error: Unable to load Imaginator Configuration',
                1,
                $exception
            );
        }
        // set the Imaginator configuration to config
        $this->config = $this->packageConfig['Imaginator'];
    }

    public function load ($image)
    {

    }

    public function loadImage ($image)
    {

    }

    public function add ($image)
    {

    }

    public function addImage ($image)
    {

    }


    public function remove ($image)
    {

    }

    public function removeImage ($image)
    {

    }
}