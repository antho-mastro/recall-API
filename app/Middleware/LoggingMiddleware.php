<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vanier\Api\Models\AccessLogModel;


class AppLoggingMiddleware implements MiddlewareInterface
{
    public function __construct(array $options = [])
    {
    }
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $uri = $request->getUri();
        $method = $request->getMethod();

        $token_payload = $request->getAttribute(APP_JWT_TOKEN_KEY);
        if(!$token_payload){
            // echo "test"; exit;

        }
        else{
            $logging_model = new AccessLogModel();
        $request_info = $_SERVER["REMOTE_ADDR"] . ' '. $request->getUri()->getPath();
        // var_dump($token_payload); exit;
        $logging_model->logUserAction($token_payload, $request_info);
        }

        return $handler->handle($request);
    }

}