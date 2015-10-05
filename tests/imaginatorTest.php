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
        $imaginator = new Imaginator($this->mockedConfig, $persistence);
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
}
