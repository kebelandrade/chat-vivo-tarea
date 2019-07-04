<?php

require_once 'vendor/autoload.php';

use Ratchet\App;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\Server\EchoServer;

class Chat implements MessageComponentInterface
{

    public $conexiones = [];

    function onOpen(\Ratchet\ConnectionInterface $conn)
    {
        echo 'Hay una nueva conexión';
        foreach ($this->conexiones as $conexion){
            /** @var Ratchet\ConnectionInterface $conexion **/
            $conexion->send("Se ha conectado un nuevo usuario");
        }

        $this->conexiones[] = $conn;
    }

    function onClose(\Ratchet\ConnectionInterface $conn)
    {

    }

    function onError(\Ratchet\ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    function onMessage(\Ratchet\ConnectionInterface $from, $msg)
    {
        /** @var Ratchet\ConnectionInterface $conexion **/
        foreach ($this->conexiones as $conexion){
            if ($conexion !== $from) {
                $conexion->send($msg);
            }
        }
    }

}

$app = new Ratchet\App('localhost', 8000);
$app->route('/chat', new Chat, array('*'));
$app->route('/echo', new Ratchet\Server\EchoServer, array('*'));
$app->run();