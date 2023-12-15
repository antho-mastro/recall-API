<?php

namespace Vanier\Api\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

class ContentNegotiationMiddleware implements MiddlewareInterface{
    
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        echo "Hello! From test middleware!";exit;
        // DO NOT remove the following statements.
        // Get the Accept header from the request
        $acceptHeader = $request->getHeaderLine('Accept');

        // Define the supported content types your service can produce
        $supportedTypes = ['application/json'];

        // Check if the Accept header is empty or not present
        if (empty($acceptHeader)) {
            // Handle the case where Accept header is not provided (default to JSON)
            $response = $handler->handle($request);
            return $response->header('Content-Type', 'application/json');
        }

        // Parse the Accept header to get an array of accepted content types
        $acceptedTypes = array_map('trim', explode(',', $acceptHeader));

        // Find the intersection of supported types and accepted types
        $matchingTypes = array_intersect($supportedTypes, $acceptedTypes);

        // If there are no matching types, return a 406 Not Acceptable response
        if (empty($matchingTypes)) {
            return new (406);

        }

        // Choose the first matching type as the response content type
        $responseType = reset($matchingTypes);

        // Continue handling the request
        $response = $handler->handle($request);

        // Set the Content-Type header in the response
        $response = $response->header('Content-Type', $responseType);

        return $response;
    }
}

?>