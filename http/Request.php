<?php

namespace http;

class Request
{
    public function __construct(
        public readonly array $server,
        public readonly array $get,
        public readonly array $post,
    ) {
    }

    public function isMethod(string $method): bool {
        return strtoupper($this->server['REQUEST_METHOD']) === strtoupper($method);
    }

}