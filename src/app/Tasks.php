<?php
namespace App;
use PDO;

interface taskInterface
{
    public static function validateTask();
    public function addTask($userId, $categoryId, $status, $contents, $deadline): void;
}

abstract class AbstractTask implements taskInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Task extends AbstractTask
{
    public static function validateTask()
    {
        if(empty($_POST['categoryName'])) {
            $_SESSION['errorTaskAdd'] = 'カテゴリが選択されていません';
            header('Location: /task/create.php');
            exit();
        }
        if(empty($_POST['contents'])) {
            $_SESSION['errorTaskAdd'] = 'タスク名が入力されていません';
            header('Location: /task/create.php');
            exit();
        }
        if(empty($_POST['deadline'])) {
            $_SESSION['errorTaskAdd'] = '締切日が入力選択されていません';
            header('Location: /task/create.php');
            exit();
        }
    }

    public function addTask($userId, $categoryId, $status, $contents, $deadline): void
    {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $smt = $this->pdo->prepare('INSERT INTO tasks(user_id, category_id, status, contents, deadline, created_at, updated_at) VALUES(:user_id, :category_id, :status, :contents, :deadline, :created_at, :updated_at)');
        $smt->bindParam(':user_id', $userId);
        $smt->bindParam(':category_id', $categoryId);
        $smt->bindParam(':status', $status);
        $smt->bindParam(':contents', $contents);
        $smt->bindParam(':deadline', $deadline);
        $smt->bindParam(':created_at', $created_at);
        $smt->bindParam(':updated_at', $updated_at);
        $smt->execute();
    }
}