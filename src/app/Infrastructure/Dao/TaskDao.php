<?php
namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Task\NewTask;
use \PDO;
use PDOException;

final class TaskDao
{
    const TABLE_NAME = 'tasks';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbname=todo;host=mysql;charset=utf8',
                'root',
                'password'
            );
        } catch (PDOException $e) {
            exit('DB接続エラー: ' . $e->getMessage());
        }
    }

    public function create(NewTask $task): void
    {
        $sql = sprintf(
            'INSERT INTO %s (user_id, category_id, status, deadline, contents) VALUES (:user_id, :category_id, :status, :deadline, :contents)',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':user_id', $task->user_id()->value(), PDO::PARAM_INT);
        $statement->bindValue(':category_id', $task->category_id()->value(), PDO::PARAM_INT);
        $statement->bindValue(':status', $task->status()->value(), PDO::PARAM_INT);
        $statement->bindValue(':deadline', $task->deadline()->value(), PDO::PARAM_STR);
        $statement->bindValue(':contents', $task->contents()->value(), PDO::PARAM_STR);
        $statement->execute();
    }
}
