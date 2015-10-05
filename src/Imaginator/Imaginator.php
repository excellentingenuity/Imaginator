<?php

namespace eig\Imaginator;

use eig\Configurator\Configurator as Config;
use eig\Configurator\Configurator;
use eig\Configurator\Options as ConfigOptions;
use eig\Imaginator\Exceptions\ImaginatorException;
use eig\Imaginator\Interfaces\ImaginatorRecordPersistenceProviderInterface;

class Imaginator
{
    protected $config;

    protected $packageConfig;

    protected $persistence;

    public function __construct (
        Configurator $config,
        ImaginatorRecordPersistenceProviderInterface $persistence
    )
    {
        $this->persistence = $persistence;
        $this->config = $config['Imaginator'];
        $this->packageConfig = $config;
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

    /**
     * load
     *
     * @param  string|array $image
     * @return Image|ImageCollection
     * @throws ImaginatorException
     *
     */
    public function load ($image)
    {
        $arguments = [$image];
        try {
            $this->checkArguments($arguments);
        } catch (\Exception $exception) {
            throw new ImaginatorException(
                'invalid argument supplied to load function',
                1,
                $exception
            );
        }
        return $this->persistence->load('image loading');
    }

    /**
     * loadImage
     *
     * @param  string|array $image
     * @return Image|ImageCollection
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
     * @param  string|array $image
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
     * @param  string|array $image
     * @return true
     * @throws ImaginatorException
     *
     */
    public function removeImage ($image)
    {
        return $this->remove($image);
    }
}