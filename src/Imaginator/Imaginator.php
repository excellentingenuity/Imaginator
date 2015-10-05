<?php

namespace eig\Imaginator;

use eig\Configurator\Configurator as Config;
use eig\Configurator\Options as ConfigOptions;

class Imaginator
{
    protected $configFiles = [
        [
            'source' => 'Imaginator.json',
            'path' => '/config/',
            'pathType' => 'relative',
            'type' => 'json',
            'alias' => 'Imaginator'
        ],
    ];

    protected $config;

    protected $configOptions;

    public function __construct() {
        $this->configOptions = new ConfigOptions();
        $this->configOptions->basePath = realpath('config');
        $this->config = new Config($this->configFiles, $this->configOptions);
    }

    public function images_dir() {
        return $this->config['Imaginator']['images_dir'];
    }
}