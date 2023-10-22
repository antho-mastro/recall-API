<?php
namespace Vanier\Api\Exceptions;

class HttpIdontKnowException extends HttpSpecializedException
{
    /**
     * @var int
     */
    protected $code = 424;

    /**
     * @var string
     */
    protected $message = 'Bad request.';

    protected string $title = 'CHANGE ME';
    protected string $description = 'The requested resource could not be found. Please verify the URI and try again.';
}



?>