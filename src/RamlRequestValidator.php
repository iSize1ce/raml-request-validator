<?php

namespace RamlRequestValidator;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Yaml\Yaml;

class RamlRequestValidator
{
    /**
     * @var array
     */
    private $raml;

    public function __construct(string $pathToYaml)
    {
        $this->raml = Yaml::parseFile($pathToYaml, Yaml::PARSE_CUSTOM_TAGS);
    }

    public function validate(ServerRequestInterface $request): ValidationResult
    {
    }

    public function test()
    {
        $routesParser = new RoutesParser($this->raml);

        var_dump($routesParser->getRoutes());
    }
}