<?php

namespace tests\client;

use PHPUnit\Framework\TestCase;
use PhpStorage\Client\SocketClient;

/**
 * Class SocketClientTest
 * @package tests\client
 */
class SocketClientTest extends TestCase
{
    public function testRequest()
    {
        $socket = new SocketClient('tcp', getenv('serverAddress'), getenv('serverPort'));

        for ($i = 0; $i < 100000; $i++) {
            echo "{$i}. " . $socket->request("{$i} req");
        }
    }
}