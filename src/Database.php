<?php
namespace SwooleChat;

use PDO;

class Database
{
    private $pdo;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=swoole_chat';
        $username = 'root';
        $password = '';

        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getMessages()
    {
        $stmt = $this->pdo->query("SELECT * FROM messages");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveMessage($message)
    {
        $stmt = $this->pdo->prepare("INSERT INTO messages (content) VALUES (:message)");
        $stmt->execute([':message' => $message]);
    }
}
