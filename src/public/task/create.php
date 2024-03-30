<?php
require_once '../common/auth.php';
require '../../app/Categories.php';
use App\Category;
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

$categoryModel = new Category($pdo);
$allCategories = $categoryModel->getCategories();
$categoryNames = "";

$errorTaskAdd = "";
if(isset($_SESSION['errorTaskAdd'])) {
    $errorTaskAdd = $_SESSION['errorTaskAdd'];
    unset($_SESSION['errorTaskAdd']);
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
        <!-- カテゴリを追加リンク -->
        <div>
            <a href="../category/index.php">カテゴリを追加</a>
        </div>
        <!-- タスク追加 -->
        <form action="../../process/task/store.php" method="POST" style="display: flex;">
            <div>
                <select name="categoryName">
                    <option disabled selected style="display:none;">カテゴリを選んでください</option>
                    <?php foreach($allCategories as $allCategory): ?>
                    <option>
                        <?php echo $allCategory['name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <input type="text" name="contents" placeholder="タスクを追加">
            </div>
            <div>
                <input type="date" name="deadline" min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div>
                <button type="submit" name="create">追加</button>
            </div>
        </form>
        <div>
            <?php echo $errorTaskAdd ?>
        </div>
        <!-- ホームリンク -->
        <div>
            <a href="../index.php">戻る</a>
        </div>
    </div>
    
</body>
</html>
