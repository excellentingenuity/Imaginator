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
        $this->loadConfiguration();
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
        // set the Imaginator configuration to config
        $this->config = $this->packageConfig['Imaginator'];
    }

    protected function checkArguments (array $arguments)
    {
        foreach ($arguments as $argument) {
            if ( is_array($argument) == false && is_string($argument) == false ) {
                throw new ImaginatorException(
                    'invalid argument supplied,
                    argument must be a string or an array',
                    1
                );
            }
        }
    }

    public function load ($image)
    {
        $arguments = array($image);
        try {
            $this->checkArguments($arguments);
        } catch (\Exception $exception) {
            throw new ImaginatorException(
                'inavlid argument supplied to load function',
                1,
                $exception
            );
        }
        return 'image loaded';
    }

    /**
     * loadImage
     *
     * @param string|array $image
     * @return Image
     * @throws ImaginatorException
     *
     */
    public function loadImage ($image)
    {
        return $this->load($image);
    }

    public function add ($image)
    {

    }

    /**
     * addImage
     *
     * @param string|array $image
     * @return true
     * @throws ImaginatorException
     *
     */
    public function addImage ($image)
    {
        return $this->add($image);
    }


    public function remove ($image)
    {

    }

    /**
     * removeImage
     *
     * @param string|array $image
     * @return true
     * @throws ImaginatorException
     *
     */
    public function removeImage ($image)
    {
        return $this->remove($image);
    }
}