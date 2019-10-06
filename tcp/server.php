#!/usr/bin/env php

<?php

error_reporting(E_ALL);

require_once realpath(dirname(__FILE__) . '/../helper.php');

set_time_limit(0);
ob_implicit_flush();

$addr = '127.0.0.1';
$port = 5000;

$socket = stream_socket_server("tcp://{$addr}:{$port}", $errno, $errstr);
if (!$socket) {
    echo "$errstr ($errno)\n";
    exit(1);
}

echo "Listening on {$addr}:{$port}\n";

while ($conn = stream_socket_accept($socket, -1)) {
    $request = fgets($conn);
    $request = str_replace("\r\n", "", $request);

    fwrite($conn, "Response to {$request} " .  date('H:i:s') . "\n");
    fclose($conn);
}

fclose($socket);