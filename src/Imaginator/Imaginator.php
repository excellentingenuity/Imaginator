<?php

namespace eig\Imaginator;

use eig\Configurator\Configurator;
use eig\Imaginator\Exceptions\ImaginatorException;
use eig\Imaginator\Interfaces\ImaginatorRecordPersistenceProviderInterface;
use DataLibrary\Validator\ValidatorFacade as Validator;

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

    // Loaders

    /**
     * load
     *
     * @param  string|array $image
     * @return Image|ImageCollection
     * @throws ImaginatorException
     *
     */
    public function load ($uuid)
    {
        try {
            $this->checkArguments($uuid, $type = ['string', 'array']);
        } catch (\Exception $exception) {
            throw new ImaginatorException(
                'invalid argument supplied to load function',
                1,
                $exception
            );
        }
        return $this->persistence->load($uuid);
    }

    public function get($uuid) {
        return $this->load($uuid);
    }

    public function all() {
        return $this->persistence->all();
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

    protected function getImageIdentifier()
    {

    }

    protected function getObjectClass()
    {

    }

    /**
     * checkArguments
     *
     * @param mixed $argument
     * @param array $types
     *
     * @return bool
     * @throws \eig\Imaginator\Exceptions\ImaginatorException
     */
    protected function checkArguments ($argument, array $types)
    {
        foreach ($types as $type) {
            if (Validator::isValid($type, $argument, false, false, false) == true) {
                return true;
            }
        }
        throw new ImaginatorException(
            'invalid argument supplied,
            argument must be a string or an array',
            1
        );

    }
}