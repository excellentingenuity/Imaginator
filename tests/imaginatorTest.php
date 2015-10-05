<?php

namespace eig\Imaginator\Tests;

use eig\Imaginator\Imaginator;

/**
 * User: James Johnson
 * Date: 10/4/15
 * Time: 2:35 PM
 */
class ImaginatorTest extends \PHPUnit_Framework_TestCase
{

    protected $imaginator;

    public function setup()
    {
        $this->imaginator = new Imaginator();
    }

    /**
     * testConstructor
     *
     * @test
     */
    public function testConstructor() {
        $this->assertInstanceOf('eig\Imaginator\Imaginator', new Imaginator('example\imaginator.json'));
    }

    public function testConfigImagesDir() {
        $this->assertEquals('public/images', $this->imaginator->images_dir());
    }
}
