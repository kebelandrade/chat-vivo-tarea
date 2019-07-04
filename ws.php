<?php

require_once 'vendor/autoload.php';
require_once 'Chat.php';

use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;

$ws = new WsServer(new Chat());

// Make sure you're running this as root

$server = IoServer::factory(new HttpServer($ws), 8000);
$server->run();