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
        <!-- タスク編集 -->
        <form action="../../process/task/update.php" method="POST" style="display: flex;">
            <div>
                <select name="name" id="">
                    <option value="カテゴリ1">カテゴリ1</option>
                </select>
            </div>
            <div>
                <input type="text" name="contents" placeholder="タスクを追加" value="contents">
            </div>
            <div>
                <input type="date" value="deadline">
            </div>
            <div>
                <button type="submit" name="">更新</button>
            </div>
        </form>

        <!-- ホームリンク -->
        <div>
            <a href="../index.php">戻る</a>
        </div>
    </div>
    
</body>
</html>
