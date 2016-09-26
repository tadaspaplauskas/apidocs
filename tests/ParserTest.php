<?php
require_once __DIR__ . '/setup.php';

use Paplauskas\ApiDocs\Parser;
use Paplauskas\ApiDocs\Endpoint;

// PHPUnit_Framework_TestCase
class ParserTest extends PHPUnit_Framework_TestCase
{
    public function testLastModified()
    {
        $parser = new Parser();

        $lastModified = $parser->getLastModified();

        // let's verify the date format
        $parsed = DateTime::createFromFormat('M jS (D)', $lastModified);

        $this->assertEquals($parsed->format('M jS (D)'), $lastModified);
    }

    public function testGetLines()
    {
        $parser = new Parser();

        $lines = $parser->getLines();

        $this->assertGreaterThan(0, count($lines));
    }

    public function testFirstLineOfDocBlock()
    {
        $parser = new Parser();

        $this->assertFalse($parser->firstLineOfDocBlock('/* comment */'));
        $this->assertFalse($parser->firstLineOfDocBlock('/** comment */'));
        $this->assertTrue($parser->firstLineOfDocBlock('/**'));
    }

    public function testLastLineOfDocBlock()
    {
        $parser = new Parser();

        $this->assertTrue($parser->lastLineOfDocBlock(' comment */'));
        $this->assertFalse ($parser->lastLineOfDocBlock('/* comment'));
        $this->assertFalse($parser->lastLineOfDocBlock('comment'));
    }

    public function testInsideDocBlock()
    {
        $parser = new Parser();

        $this->assertFalse($parser->insideDocBlock(' comment '));
        $this->assertTrue($parser->insideDocBlock('* comment '));
    }

    public function testParseRouteDeclaration()
    {
        $parser = new Parser();
        $endpoint = new Endpoint();

        // GET
        $parser->parseRouteDeclaration($endpoint,
            "Route::get('resources/{resource}', 'ResourceController@show');");

        $this->assertEquals('GET', $endpoint->getMethod());
        $this->assertEquals('/resources/{resource}', $endpoint->getPath());

        // POST
        $parser->parseRouteDeclaration($endpoint,
            "Route::post('resources', 'ResourceController@store');");

        $this->assertEquals('POST', $endpoint->getMethod());
        $this->assertEquals('/resources', $endpoint->getPath());
    }

    public function testParseRouteDeclarationWithPrefixes()
    {
        $parser = new Parser();
        $endpoint = new Endpoint();

        Endpoint::pushPrefix('v1');

        // GET
        $parser->parseRouteDeclaration($endpoint,
            "Route::get('resources/{resource}', 'ResourceController@show');");

        $this->assertEquals('GET', $endpoint->getMethod());
        $this->assertEquals('/v1/resources/{resource}', $endpoint->getPath());
    }

    public function testParsePrefix()
    {
        $parser = new Parser();

        $this->assertEquals('v1', $parser->parsePrefix("Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {"));

        $this->assertEquals('v2', $parser->parsePrefix("Route::group(['prefix' => 'v2'], function () {"));

        $this->assertEquals(null, $parser->parsePrefix('dummy'));
    }

    public function testGroupEndpoints()
    {
        $parser = new Parser();

        // <stub>
        $endpointsStub = [];
        $groups = ['first', 'second'];

        for ($i = 0; $i < 10; $i++) {
            $endpoint = new Endpoint();

            $endpoint->setGroup($groups[round(rand(0, 1))]);

            $endpointsStub[] = $endpoint;
        }
        // </stub>

        $grouped = $parser->groupEndpoints($endpointsStub);

        $this->assertGreaterThan(1, count($grouped['first']));
        $this->assertGreaterThan(1, count($grouped['second']));
    }

    public function testparseTags()
    {
        $parser = new Parser();
        $endpoint = new Endpoint();

        $parser->parseTags($endpoint, '@title dummy');
        $this->assertEquals($endpoint->getTitle(), 'dummy');

        $parser->parseTags($endpoint, '@param dummy param');
        $this->assertEquals($endpoint->getParam(), ['dummy param']);

        $parser->parseTags($endpoint, '@return dummy return');
        $this->assertEquals($endpoint->getReturn(), ['dummy return']);

        $parser->parseTags($endpoint, 'description by default');
        $this->assertEquals($endpoint->getDescription(), 'description by default');
    }
}
