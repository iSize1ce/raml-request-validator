<?php

namespace RamlRequestValidator;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

class RoutesParserTest extends TestCase
{
    private function getRamlArray(): array
    {
        return Yaml::parse(<<<RAML
/foo:
    headers:
        Test-Header: string
    /bar:
        headers:
            Test-Header2:
                type: integer
/bar:
    headers:
        Test-Header: string
RAML
        );
    }

    public function test_getRoutes(): void
    {
        $parser = new RoutesParser($this->getRamlArray());

        $header1 = new NamedType('Test-Header', NamedType::TYPE_STRING);
        $header2 = new NamedType('Test-Header2', NamedType::TYPE_INTEGER);

        $expected = [
            '/foo' => (new Route())
                ->setUri('/foo')
                ->setHeaders([
                    $header1
                ]),
            '/foo/bar' => (new Route())
                ->setUri('/foo/bar')
                ->setHeaders([$header1, $header2]),
            '/bar' => (new Route())
                ->setUri('/bar')
                ->setHeaders([
                    new NamedType('Test-Header', NamedType::TYPE_STRING)
                ])
        ];

        $actual = $parser->getRoutes();

        $this->assertEquals($expected, $actual);
    }
}