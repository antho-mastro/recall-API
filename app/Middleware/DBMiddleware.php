<?php

namespace Vanier\Api\Middlewares;

use DateTimeZone;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vanier\Api\Exceptions\HttpNotAcceptableException;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Vanier\Api\Helpers\AppLogHelper;
use Vanier\Api\Models\LoggingModel;
use Vanier\Api\Models\WSLoggingModel;

class DBLoginMiddleware implements MiddlewareInterface
{
    public function __construct()
    {

    }

    /**
     * process
     * gets the login information to write to the database
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     */
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        
        $uri = $request->getUri();
        if (strpos($uri, 'account') !== false || strpos($uri, 'token') !== false) {
            return $handler->handle($request);
        }
        $token_payload = $request->getAttribute(APP_JWT_TOKEN_KEY);
        $logging_model = new LoggingModel();
        $request_info = $_SERVER["REMOTE_ADDR"]. ' ' .$request->getUri()->getPath();
        $logging_model->logUserAction($token_payload, $request_info);
        $response = $handler->handle($request);

        return $response;
    }
}