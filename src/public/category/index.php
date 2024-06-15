<?php
session_start();
ob_start();
require '../../app/Categories.php';
use App\Category;
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

if(!isset($_SESSION['id'])) {
    header('Location: /user/signin.php');
}
$userId = $_SESSION['id'];
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);


$errorCategoryDelete = "";
if(isset($_SESSION['errorDeleteCategory'])) {
    $errorCategoryDelete = $_SESSION['errorDeleteCategory'];
    unset($_SESSION['errorDeleteCategory']);
}

$categoryModel = new Category($pdo);
$allCategories = $categoryModel->getCategories($userId);



?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDoアプリ</title>
  <link rel="stylesheet" href="../css/modal.css">
</head>
<body>

    <?php include '../header/header.php'; ?>

    <div>
        <div>
            <h1>カテゴリ一覧</h1>
        </div>
        <!-- カテゴリ追加 -->
        <p class="open-modal">カテゴリを追加する</p>
        <div>
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
        <dialog class="dialog">
            <div class="dialog-inner">
                <form class="form" action="../process/category/store.php" method="POST">
                    <input class="input" type="text" name="name" placeholder="カテゴリー追加">
                    <button class="button" type="submit">登録</button>
                </form>
            </div>
        </dialog>

        <!-- カテゴリー一覧 -->
        <div>
            <?php foreach($allCategories as $allCategory): ?>
                <div style="display: flex;">
                    <div>
                        <p><?php echo $allCategory['name'] ?></p>
                    </div>
                    <div style="line-height: 55px;">
                        <a href="edit.php?id=<?php echo $allCategory['id']; ?>">編集</a>
                    </div>
                    <div>
                        <form action="../../process/category/delete.php" method="POST" style="line-height: 55px;">
                            <input type="hidden" name="category_id" value="<?php echo $allCategory['id']; ?>">
                            <button type="submit" name="delete">削除</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div>
            <?php echo $errorCategoryDelete ?>
        </div>

        <!-- タスク作成リンク -->
        <div>
            <a href="../task/create.php">戻る</a>
        </div>
    </div>

    <script src="../js/modal.js"></script>
    
</body>
</html>
