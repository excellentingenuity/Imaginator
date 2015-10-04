<?php

namespace eig\Imaginator;

use eig\Configurator\Configurator;

class Imaginator
{
    protected $config_files = [
        [
            'source' => 'Imaginator.json',
            'path' => '/config/',
            'pathType' => 'relative',
            'type' => 'json',
            'alias' => 'Imaginator'
        ],
    ];
    protected $config = null;

    public function __construct() {
        $this->config = Configurator::make($this->config_files);
    }
}