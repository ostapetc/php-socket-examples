#!/usr/bin/env php

<?php

error_reporting(E_ALL);

require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');
require_once realpath(dirname(__FILE__) . '/../helper.php');

if (!isset($argv[1])) {
    $argv[1] = rand(1, 100000);
}


$name = $argv[1];
$addr = '127.0.0.1';
$port = 5000;

$client = new \PhpStorage\Client\SocketClient('tcp', $addr, $port, getLogger());

for ($i = 0; $i < 100000; $i++) {
    echo $i . "\n";
    $client->request("Client {$name} request {$i}");
}

