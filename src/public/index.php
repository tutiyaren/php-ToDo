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

    <?php include 'header/header.php'; ?>

    <div>
        <!-- 絞り込み -->
        <div>
            <h1>絞り込み機能</h1>
            <form  action="" method="GET">
                <div style="display: flex;">
                    <input type="text" name="contents" placeholder="キーワードを入力">
                    <div>
                        <div>
                            <input type="radio" name="" id="newCreated">
                            <label for="newCreated">新着順</label>
                        </div>
                        <div>
                            <input type="radio" name="" id="oldCreated">
                            <label for="oldCreated">古い順</label>
                        </div>
                    </div>
                    <div>
                        <select name="name" id="">
                            <option value="" disabled selected style="display:none;">カテゴリ</option>
                            <option value="">1</option>
                        </select>
                    </div>
                    <div>
                        <div>
                            <input type="radio" name="" id="completed">
                            <label for="completed">完了</label>
                        </div>
                        <div>
                            <input type="radio" name="" id="incomplete">
                            <label for="incomplete">未完了</label>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" name="">Button</button>
                </div>
            </form>
        </div>

        <!-- タスク追加 -->
        <div>
            <a href="task/create.php">タスクを追加</a>
        </div>

        <!-- タスク一覧 -->
        <table border="1" style="border-collapse: collapse">
            <tr style="border-top: none; border-left: none; border-right: none;">
                <th>タスク名</th>
                <th>締め切り</th>
                <th>カテゴリー名</th>
                <th>完了未完了</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            <!-- foreach -->
            <tr>
                <td>タスクA</td>
                <td>2024-12-30</td>
                <td>カテゴリー1</td>
                <td>
                    <form action="../process/task/updateStatus.php" method="POST">
                        <button type="submit" name="">完了 or 未完了</button>
                    </form>
                </td>
                <td>
                    <a href="task/edit.php">編集</a>
                </td>
                <td>
                    <form action="../process/task/delete.php" method="POST">
                        <button type="submit" name="">削除</button>
                    </form>
                </td>
            </tr>
        </table>

    </div>
    
</body>
</html>
