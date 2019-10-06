<?php
declare(strict_types=1);

namespace PhpStorage\Exception;

use Throwable;

/**
 * Class SocketException
 * @package src\exception
 */
class SocketException extends \Exception
{
    /**
     * SocketException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if ($message === "" && $code === 0) {
            $code    = socket_last_error();
            $message = socket_strerror($code);
        }

        parent::__construct($message, $code, $previous);
    }
}