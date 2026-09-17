<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class LogMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $start = microtime(true);

        $response = $handler->handle($request);


        $durationMs = round((microtime(true) - $start) * 1000, 2);

        $fecha  = date('Y-m-d H:i:s');
        $metodo = $request->getMethod();
        $ruta   = $request->getUri()->getPath();
        $status = $response->getStatusCode();

        $linea = sprintf(
            '[%s] %s %s - %d - %sms%s',
            $fecha,
            $metodo,
            $ruta,
            $status,
            $durationMs,
            PHP_EOL
        );

        echo $linea;
        file_put_contents(__DIR__ . '/../../storage/app.log', $linea, FILE_APPEND);

        return $response;
    }
}
