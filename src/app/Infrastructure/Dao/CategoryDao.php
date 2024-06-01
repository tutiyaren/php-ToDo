<?php
namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Category\NewCategory;
use App\Domain\ValueObject\Category;
use \PDO;
use PDOException;

final class CategoryDao
{
    const TABLE_NAME = 'categories';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbname=todo;host=mysql;charset=utf8',
                'root',
                'password'
            );
        } catch(PDOException $e) {
            exit('DB接続エラー: ' . $e->getMessage());
        }
    }

    public function create(NewCategory $category): void
    {
        $sql = sprintf(
            'INSERT INTO %s (user_id, name) VALUES (:user_id, :name)',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':user_id', $category->user_id()->value(), PDO::PARAM_INT);
        $statement->bindValue(':name', $category->name()->value(), PDO::PARAM_STR);
        $statement->execute();
    }
}
