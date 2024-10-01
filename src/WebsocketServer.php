<?php
namespace SwooleChat;

use Swoole\WebSocket\Server as WebSocketServer;

class WebsocketServer
{
    private $server;

    public function __construct()
    {
        $this->server = new WebSocketServer("0.0.0.0", 9502);

        // Cuando un cliente se conecta
        $this->server->on("open", function ($server, $request) {
            echo "Conexión abierta: {$request->fd}\n";
        });

        // Cuando recibe un mensaje
        $this->server->on("message", function ($server, $frame) {
            echo "Mensaje recibido: {$frame->data}\n";
            
            // Enviar el mensaje a todos los usuarios conectados
            foreach ($server->connections as $fd) {
                if ($server->isEstablished($fd)) {
                    $server->push($fd, $frame->data);
                }
            }
        });

        // Cuando un cliente se desconecta
        $this->server->on("close", function ($server, $fd) {
            echo "Conexión cerrada: {$fd}\n";
        });
    }

    public function start()
    {
        $this->server->start();
    }
}
