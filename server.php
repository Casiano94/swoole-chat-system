<?php
require 'vendor/autoload.php';

use SwooleChat\WebsocketServer;
use SwooleChat\RestApi;

// Iniciar el servidor WebSocket
$wsServer = new WebsocketServer();
$wsServer->start();

// Iniciar el servidor RESTful
$apiServer = new RestApi();
$apiServer->start();
