<?php

namespace eig\Imaginator;

use eig\Configurator\Configurator as Config;
use eig\Configurator\Options as ConfigOptions;

class Imaginator
{
    protected $configFiles = [
        [
            'source' => 'ImaginatorConfiguration.php',
            'path' => '/config/',
            'pathType' => 'relative',
            'type' => 'array',
            'alias' => 'Imaginator'
        ],
    ];

    protected $config;

    protected $packageConfig;

    protected $configOptions;

    public function __construct($configurationFile = null) {

        $this->loadConfiguration($configurationFile);

    }

    protected function loadConfiguration($configurationFile) {
        $this->configOptions = new ConfigOptions();
        if ($configurationFile == null) {
            $this->configOptions->basePath = realpath('config');
        } else {
            $this->configOptions->basePath = realpath($configurationFile);
        }
        $this->packageConfig = new Config($this->configFiles, $this->configOptions);
        $this->config = $this->packageConfig['Imaginator'];
    }

    public function load($file) {

    }

    public function add($file) {

    }

    public function remove($file) {

    }
}