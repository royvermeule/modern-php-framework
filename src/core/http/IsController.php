<?php

declare(strict_types=1);

namespace Src\core\http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

trait IsController
{
    private readonly Request $request;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

    private function json(
        array $data,
        int $status = 200,
        array $headers = [],
    ): Response
    {
        $applicationJson = ['Content-Type' => 'application/json'];
        $headers = array_merge($headers, $applicationJson);

        $json = json_encode($data);
        if ($json === false) {
            throw new \RuntimeException('Failed to encode json');
        }
        return new Response($json, $status, $headers);
    }
}