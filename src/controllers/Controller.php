<?php

namespace Src\controllers;

use Src\core\http\IController;
use Src\core\http\IsController;
use Symfony\Component\HttpFoundation\Response;

final class Controller implements IController
{
    use IsController;

    public function index(): Response
    {
        return new Response('Hello World!');
    }

    public function getMessage(): Response
    {
        return $this->json(['message' => 'Hello World']);
    }
}