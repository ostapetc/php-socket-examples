<?php
declare(strict_types=1);

namespace PhpStorage\Client;

use PhpStorage\Exception\SocketException;
use Psr\Log\LoggerInterface;

/**
 * Class SocketClient
 * @package src\client
 */
class SocketClient
{
    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var int 
     */
    protected $timeout = 300;

    /**
     * SocketClient constructor.
     * @param string $protocol
     * @param string $address
     * @param int $port
     * @param LoggerInterface $logger
     */
    public function __construct(string $protocol, string $address, int $port, LoggerInterface $logger)
    {
        $this->protocol = $protocol;
        $this->address  = $address;
        $this->port     = $port;
        $this->logger   = $logger;
    }

    /**
     * @param string $data
     * @return string
     */
    public function request(string $data) : string 
    {
        $this->logger->debug("Got request {$data}");

        $socket = @stream_socket_client("{$this->protocol}://{$this->address}:{$this->port}", $errno, $errstr, $this->timeout);
        if (!$socket) {
            throw new SocketException($errstr, $errno);
        }

        if (fwrite($socket, "{$data}\r\n") === false) {
            throw new SocketException();
        }

        $response = "";

        while (!feof($socket)) {
            $response .= fgets($socket, 1024);
        }
        
        fclose($socket);

        $this->logger->debug("Return response {$response}");

        return $response;
    }
}
