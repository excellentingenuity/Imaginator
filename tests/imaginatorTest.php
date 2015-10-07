<?php

namespace eig\Imaginator\Tests;

use eig\Configurator\Configurator;
use eig\Configurator\Options;
use eig\Imaginator\Factory\ImaginatorFactory;
use eig\Imaginator\Imaginator;
use StevenWadeJr\Exposure\Factory as Exposure;
use Mockery;


class ImaginatorTest extends \PHPUnit_Framework_TestCase
{

    protected $imaginator;

    protected $exposedImaginator;

    protected $mockedConfig;

    protected $mockedPersistence;

    protected $mockedSpecifierPersistence;

    public function setup ()
    {
        $files = $configFiles = [
            [
                'source'   => 'ImaginatorConfiguration.php',
                'path'     => 'config/',
                'pathType' => 'relative',
                'type'     => 'array',
                'alias'    => 'Imaginator'
            ],
        ];
        $options = new Options();
        $options->basePath = realpath('config');
        $this->imaginator = ImaginatorFactory::make();
        $this->mockedConfig = new Configurator($files, $options);
        $this->mockedPersistence = Mockery::mock('eig\Imaginator\Providers\ImaginatorFileRecordPersistence');
        $this->mockedSpecifierPersistence = Mockery::mock('eig\Imaginator\Providers\ImaginatorFileSpecifierPersistence');
        //$this->mockedConfig['Imaginator']['Record Persistence Provider'] = 'eig\Imaginator\Providers\ImaginatorFileRecordPersistence';

    }

    public function tearDown() {
        Mockery::close();
    }

    /**
     * testConstructor
     *
     * @test
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            'eig\Imaginator\Imaginator',
            ImaginatorFactory::make()
        );
    }

    /**
     * testConfigImagesDir
     *
     * @test
     *
     */
    public function testConfigImagesDir()
    {
        $this->exposedImaginator = Exposure::expose(ImaginatorFactory::make());
        $this->assertEquals(
            'public/images',
            $this->exposedImaginator->config['Images Directory']
        );
    }

    /**
     * testLoad
     *
     * @test
     *
     */
    public function testLoad()
    {
        $persistence = Mockery::mock('eig\Imaginator\Providers\ImaginatorFileRecordPersistence');
        $persistence->shouldReceive('load')->once()->andReturn('image loaded');
        $imaginator = new Imaginator($this->mockedConfig, $persistence, $this->mockedSpecifierPersistence);
        $this->assertEquals('image loaded', $imaginator->load('image file'));
    }

    /**
     * testLoadFail
     *
     * @test
     * @expectedException eig\Imaginator\Exceptions\ImaginatorException
     */
    public function testLoadFail()
    {
        $this->setExpectedExceptionFromAnnotation();
        $this->imaginator->load(2);
    }

    public function testGet() {
        $this->mockedPersistence->shouldReceive('load')->once()->andReturn('image loaded');
        $imaginator = new Imaginator($this->mockedConfig, $this->mockedPersistence, $this->mockedSpecifierPersistence);
        $this->assertEquals('image loaded', $imaginator->load('image file'));
    }

    /**
     * testGetFail
     *
     * @test
     * @expectedException eig\Imaginator\Exceptions\ImaginatorException
     */
    public function testGetFail() {
        $this->setExpectedExceptionFromAnnotation();
        $this->imaginator->load(2);
    }


    public function testAll() {
        $this->mockedPersistence->shouldReceive('all')->once()->andReturn('image loaded');
        $imaginator = new Imaginator($this->mockedConfig, $this->mockedPersistence, $this->mockedSpecifierPersistence);
        $this->assertEquals('image loaded', $imaginator->all('collection of images'));
    }
}
