<?php

namespace Vanier\Api\Middleware;

use LogicException;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpUnauthorizedException;
use UnexpectedValueException;

use Vanier\Api\Helpers\JWTHelper;
use Vanier\Api\Helpers\JWTManager;

class JWTAuthMiddleware implements MiddlewareInterface
{

    public function __construct(array $options = [])
    {
    }
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $uri = $request->getUri();
        $method = $request->getMethod();

        if (strpos($uri, 'account') !== false || strpos($uri, 'token') !== false) {
            return $handler->handle($request);
        }
        $token = $request->getHeader('Authorization')[0] ?? '';
        $parsed_token = explode(' ', $token)[1] ?? '';

        try {
            $decoded_token = JWTManager::DecodeToken($parsed_token, JWTHelper::SIGNATURE_ALGO);
        } catch (LogicException $e) {
            throw new HttpUnauthorizedException($request, $e->getMessage(), $e);
        } catch (UnexpectedValueException $e) {
            throw new HttpUnauthorizedException($request, $e->getMessage(), $e);
        }
        if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
            $role = $decoded_token['role'] ?? 'oye';
            if ($role != 'admin') {
                throw new HttpForbiddenException($request, 'Insufficient permission!');
            }
        }

        $request = $request->withAttribute(APP_JWT_TOKEN_KEY, $decoded_token);
        return $handler->handle($request);
    }
}