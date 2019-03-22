<?php

namespace RamlRequestValidator;

class RoutesParser
{
    /**
     * @var Route[]
     */
    private $routes = [];

    public function __construct(array $raml)
    {
        $this->parse($raml);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    private function parse(array $array, string $parentUri = ''): void
    {
        foreach ($array as $key => $value) {
            if ( ! is_array($value) || strpos($key, '/') !== 0) {
                continue;
            }

            $uri = $parentUri . $key;

            if ($parentUri !== '') {
                $route = clone $this->routes[$parentUri];
            } else {
                $route = new Route();
            }

            $route->setUri($uri);

            if (array_key_exists('headers', $value)) {
                foreach ($value['headers'] as $headerName => $header) {
                    $route->addHeader(
                        new NamedType($headerName, is_string($header) ? $header : $header['type'])
                    );
                }
            }

            $this->routes[$uri] = $route;

            $this->parse($value, $uri);
        }
    }
}