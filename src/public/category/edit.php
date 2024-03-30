<?php
require_once '../common/auth.php';

use App\Category;
require '../../app/Categories.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

$categoryModel = new Category($pdo);
$categoryId = $_GET['id'];

$category = $categoryModel->getCategory($categoryId);

$errorUpdateCategory = "";
if(isset($_SESSION['errorUpdateCategory'])) {
    $errorUpdateCategory = $_SESSION['errorUpdateCategory'];
    unset($_SESSION['errorUpdateCategory']);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDoアプリ</title>
</head>
<body>

    <?php include '../header/header.php'; ?>

    <div>

        <!-- カテゴリ編集 -->
        <form action="../../process/category/update.php" method="POST">
            <input type="text" name="name" value="<?php echo $category['name'] ?>">
            <input type="hidden" name="category_id" value="<?php echo $category['id'] ?>">
            <button type="submit" name="update">更新</button>
        </form>

        <div>
            <?php echo $errorUpdateCategory ?>
        </div>

        <!-- カテゴリ一覧リンク -->
        <div>
            <a href="index.php">戻る</a>
        </div>
    </div>
    
</body>
</html>
