<?php
require_once __DIR__ . '/setup.php';

use Paplauskas\ApiDocs\Endpoint;

// PHPUnit_Framework_TestCase
class EndpointTest extends PHPUnit_Framework_TestCase
{
    public function testIsTag()
    {
        $this->assertTrue(Endpoint::isTag('method'));
        $this->assertTrue(Endpoint::isTag('path'));
        $this->assertTrue(Endpoint::isTag('group'));
        $this->assertTrue(Endpoint::isTag('title'));
        $this->assertTrue(Endpoint::isTag('description'));
        $this->assertTrue(Endpoint::isTag('return'));
        $this->assertTrue(Endpoint::isTag('param'));
        $this->assertFalse(Endpoint::isTag('dummy'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetPathWithPrefixes()
    {
        $endpoint = new Endpoint();

        Endpoint::pushPrefix('v1');
        $endpoint->setPath('resource');
        $this->assertEquals($endpoint->getPath(), '/v1/resource');

        Endpoint::popPrefix();
        $endpoint->setPath('dummy');
        $this->assertEquals($endpoint->getPath(), '/dummy');
    }
}
