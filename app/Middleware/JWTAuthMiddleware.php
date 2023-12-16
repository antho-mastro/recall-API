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

use Vanier\Api\Helpers\JWTManager;

class JWTAuthMiddleware implements MiddlewareInterface
{

    public function __construct(array $options = [])
    {
        // You can add any initialization logic here if needed.
    }

    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        /*-- 1) Routes to ignore (public routes):
              We need to ignore the routes that enable client applications
              to create an account and request a JWT token.
        */
        
        // 1.a) If the request's URI contains /account or /token, handle the request:
        $uri = $request->getUri()->getPath();
        if (strpos($uri, '/account') !== false || strpos($uri, '/token') !== false) {
            return $handler->handle($request);
        }

        // If not:
        //-- 2) Retrieve the token from the request Authorization header.
        $authorizationHeader = $request->getHeaderLine('Authorization');
        // Ensure the Authorization header is present
        if (empty($authorizationHeader)) {
            throw new HttpUnauthorizedException($request, 'Unauthorized. Token not provided.');
        }

        // 3) Parse the token: remove the "Bearer " word.
        $token = substr($authorizationHeader, 7); // Assuming "Bearer " is 7 characters.

        //-- 4) Try to decode the JWT token
        //@see https://github.com/firebase/php-jwt#exception-handling
        try {
            $tokenPayload = JWTManager::decodeJWT($token);
        } catch (\Exception $e) {
            // Handle token decoding failure
            throw new HttpUnauthorizedException($request, 'Unauthorized. Invalid token.');
        }

        // --5) Access to POST, PUT, and DELETE operations must be restricted.
        //     Only admin accounts can be authorized.
        // If the request's method is: POST, PUT, or DELETE., only admins are allowed.
        if (in_array($request->getMethod(), ['POST', 'PUT', 'DELETE']) && $tokenPayload['role'] !== 'admin') {
            throw new HttpForbiddenException($request, 'Insufficient permission!');
        }

        //-- 6) The client application has been authorized:
        // 6.a) Now we need to store the token payload in the request object. The payload is needed for logging purposes and 
        // needs to be passed to the request's handling callbacks. This will allow the target resource's callback 
        // to access the token payload for various purposes (such as logging, etc.)
        // Use the APP_JWT_TOKEN_KEY as the attribute name.
        $request = $request->withAttribute('APP_JWT_TOKEN_KEY', $tokenPayload);

        //-- 7) At this point, the client app's request has been authorized, we pass the request to the next
        // middleware in the middleware stack.
        return $handler->handle($request);
    }
}
