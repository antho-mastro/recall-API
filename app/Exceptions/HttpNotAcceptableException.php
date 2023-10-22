<?php
namespace Vanier\Api\Exceptions;

class HttpNotAcceptableException extends HttpSpecializedException
{
    /**
     * @var int
     */
    protected $code = 406;

    /**
     * @var string
     */
    protected $message = 'Not accepted';

    protected string $title = 'CHANGE ME';
    protected string $description = 'The requested resource was not accepted.';
}



?>