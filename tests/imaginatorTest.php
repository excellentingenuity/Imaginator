<?php

namespace eig\Imaginator\Tests;

use eig\Imaginator\Imaginator;
use StevenWadeJr\Exposure\Factory;

/**
 * User: James Johnson
 * Date: 10/4/15
 * Time: 2:35 PM
 */
class ImaginatorTest extends \PHPUnit_Framework_TestCase
{

    protected $imaginator;

    protected $exposedImaginator;

    public function setup ()
    {
        $this->imaginator = new Imaginator();

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
            new Imaginator('example\imaginator.json')
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
        $this->exposedImaginator = Factory::expose(new Imaginator);
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
        $this->assertEquals('image loaded', $this->imaginator->load('image file'));
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
