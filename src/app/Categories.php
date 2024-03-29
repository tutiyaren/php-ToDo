<?php
namespace App;
use PDO;

interface categoryInterface
{
    public static function validateCategory(): string;
    public function addCategory($userId, $name): void;
}

abstract class AbstractCategory implements categoryInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Category extends AbstractCategory
{
    public static function validateCategory(): string
    {
        $_SESSION['errorCategoryAdd'] = 'カテゴリ名が入力されていません';
        header('Location: /category/index.php');
        exit();
    }

    public function addCategory($userId, $name): void
    {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $smt = $this->pdo->prepare('INSERT INTO categories(user_id, name, created_at, updated_at) VALUES(:user_id, :name, :created_at, :updated_at)');
        $smt->bindParam(':user_id', $userId);
        $smt->bindParam(':name', $name);
        $smt->bindParam(':created_at', $created_at);
        $smt->bindParam(':updated_at', $updated_at);
        $smt->execute();
    }
}