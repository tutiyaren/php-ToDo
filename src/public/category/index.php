<?php
session_start();
ob_start();

$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
// ログインされていない場合にログインページにリダイレクト
if (!$userId) {
    header('Location: user/signin.php');
    exit();
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
        <div>
            <h1>カテゴリ一覧</h1>
        </div>
        <!-- カテゴリ追加 -->
        <form action="../../process/category/store.php" method="POST">
            <input type="text" name="name" placeholder="カテゴリー追加">
            <button type="submit" name="">登録</button>
        </form>

        <!-- カテゴリー一覧 -->
        <div style="display: flex;">
        <!-- foreach -->
            <div style="display: flex;">
                <div>
                    <p>各カテゴリー名</p>
                </div>
                <div style="line-height: 55px;">
                    <a href="edit.php">編集</a>
                </div>
            </div>
            <form action="../../process/category/delete.php" method="POST" style="line-height: 50px;">
                <button type="" name="">削除</button>
            </form>
        </div>

        <!-- タスク作成リンク -->
        <div>
            <a href="../task/create.php">戻る</a>
        </div>
    </div>
    
</body>
</html>
