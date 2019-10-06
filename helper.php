<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

function getLogger()
{
    // Create the logger
    $logger = new Logger('AppLogger');
    // Now add some handlers
    $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/app.log', Logger::DEBUG));
    $logger->pushHandler(new FirePHPHandler());

    // You can now use your logger
    $logger->info('My logger is now ready');

    return $logger;
}

function socketPanic()
{
    //socket_clear_error()
    $num = socket_last_error();
    $msg = socket_strerror($num);

    $bt = debug_backtrace();
    $bt = array_shift($bt);

    echo "Error num: {$num}, msg: {$msg}\n";
    echo "File: {$bt['file']} line: {$bt['line']}\n";

    exit(1);
}

function isSocketError($msg)
{
    return $msg === socket_strerror(socket_last_error());
}



