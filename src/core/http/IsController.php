<?php

declare(strict_types=1);

namespace Src\core\http;

use Symfony\Component\HttpFoundation\Response;

trait IsController
{
    private function json(
        array $data,
        int $status = 200,
        array $headers = [],
    ): Response
    {
        $applicationJson = ['Content-Type' => 'application/json'];
        $headers = array_merge($headers, $applicationJson);
        return new Response(json_encode($data), $status, $headers);
    }
}