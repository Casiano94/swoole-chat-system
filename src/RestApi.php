<?php
namespace SwooleChat;

use Swoole\Http\Server as HttpServer;

class RestApi
{
    private $server;

    public function __construct()
    {
        $this->server = new HttpServer("0.0.0.0", 9503);

        // Manejar solicitudes HTTP
        $this->server->on("request", function ($request, $response) {
            if ($request->server['request_uri'] == '/users') {
                $response->header("Content-Type", "application/json");
                $response->end(json_encode(["users" => $this->getUsers()]));
            } elseif ($request->server['request_uri'] == '/messages') {
                $response->header("Content-Type", "application/json");
                $response->end(json_encode(["messages" => $this->getMessages()]));
            } else {
                $response->status(404);
                $response->end("Not Found");
            }
        });
    }

    public function start()
    {
        $this->server->start();
    }

    private function getUsers()
    {
        // Obtener los usuarios de la base de datos
        return ["User1", "User2", "User3"];
    }

    private function getMessages()
    {
        // Obtener los mensajes de la base de datos
        return ["Hello", "How are you?", "Welcome!"];
    }
}
