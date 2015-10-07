<?php

namespace eig\Imaginator;

use eig\Configurator\Configurator;
use eig\Imaginator\Exceptions\ImaginatorException;
use eig\Imaginator\Interfaces\ImaginatorRecordPersistenceProviderInterface;
use DataLibrary\Validator\ValidatorFacade as Validator;
use eig\Imaginator\Interfaces\ImaginatorSpecifierPersistenceProviderInterface;

class Imaginator
{
    protected $config;

    protected $packageConfig;

    protected $persistence;

    protected $specifierPersistence;

    protected $with;

    protected $by;

    protected $sort;

    public function __construct (
        Configurator $config,
        ImaginatorRecordPersistenceProviderInterface $persistence,
        ImaginatorSpecifierPersistenceProviderInterface $specifierPersistence
    )
    {
        $this->persistence = $persistence;
        $this->specifierPersistence = $specifierPersistence;
        $this->config = $config['Imaginator'];
        $this->packageConfig = $config;
    }

    /*
    |--------------------------------------------------------------------------
    | Chainable Methods
    |--------------------------------------------------------------------------
    | Chainable methods with corresponding properties
    | and a clearChains method to clear out the chain
    | after each use of a chainable method
    */


    public function with($modifier, $value) {

    }

    public function by($modifier, $value) {

    }

    public function sort($key, $value, $order) {

    }

    protected function clearChain()
    {
        $this->by = null;
        $this->with = null;
        $this->sort = null;
    }

    protected function checkChain() {
        if ($this->by != null || $this->with != null || $this->sort != null) {
            return true;
        }
        return false;
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

    public function loadBySpecifier($specifier, $id, $uuid) {

    }

    public function loadByAssociation($specifier) {

    }

    public function loadByDate($date) {

    }

    public function loadThumbnail($uuid) {

    }

    public function get($uuid) {
        return $this->load($uuid);
    }

    public function getAssociated($specifier) {

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