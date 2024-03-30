<?php
namespace App;
use PDO;

interface categoryInterface
{
    public static function validateCategory(): string;
    public function addCategory($userId, $name): void;
    public function getCategories();
    public function getCategory($categoryId);
    public function deleteCategory($category_id);
    public function updateCategory($category_id, $name);
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

    public function getCategories()
    {
        $smt = $this->pdo->query('SELECT * FROM categories');
        return $smt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCategory($category_id)
    {
        $taskCountQuery = $this->pdo->prepare('SELECT COUNT(*) FROM tasks WHERE category_id = :category_id');
        $taskCountQuery->execute(array(':category_id' => $category_id));
        $taskCount = $taskCountQuery->fetchColumn();
        if ($taskCount > 0) {
            $_SESSION['errorDeleteCategory'] = '現在タスクで使用されているので削除できません';
            return;
        }

        $smt = $this->pdo->prepare('DELETE FROM categories WHERE id = :id');
        $smt->execute(array(':id' => $category_id));
    }

    public function getCategory($categoryId)
    {
        $smt = $this->pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $smt->execute(['id' => $categoryId]);
        $category = $smt->fetch(PDO::FETCH_ASSOC);
        return $category;
    }

    public function updateCategory($category_id, $name)
    {
        $smt = $this->pdo->prepare('UPDATE categories SET name = :name WHERE id = :id');
        $smt->execute(array(':id' => $category_id, ':name' => $name));
    }
}