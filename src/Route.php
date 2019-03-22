<?php

namespace RamlRequestValidator;

class Route
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var NamedType[]
     */
    private $queryParameters;

    /**
     * @var NamedType[]
     */
    private $headers = [];

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): Route
    {
        $this->method = $method;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): Route
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return  NamedType[] $headers
     */
    public function getQueryParameters(): array
    {
        return $this->queryParameters;
    }

    /**
     * @param NamedType[] $queryParameters
     */
    public function setQueryParameters(array $queryParameters): Route
    {
        $this->queryParameters = $queryParameters;

        return $this;
    }

    /**
     * @return NamedType[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param NamedType[] $headers
     */
    public function setHeaders(array $headers): Route
    {
        $this->headers = $headers;

        return $this;
    }

    public function addHeader(NamedType $header): Route
    {
        $this->headers[] = $header;

        return $this;
    }
}