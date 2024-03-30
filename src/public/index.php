<?php
require_once 'common/auth.php';
require '../app/Tasks.php';
use App\Task;
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

$errorTaskDelete = "";
if(isset($_SESSION['errorDeleteTask'])) {
    $errorTaskDelete = $_SESSION['errorDeleteTask'];
    unset($_SESSION['errorDeleteTask']);
}

$taskModel = new Task($pdo);
$allTasks = $taskModel->getTasks($userId);

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
            <a href="/task/create.php">タスクを追加</a>
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
            <?php foreach($allTasks as $allTask): ?>
                <tr>
                    <td><?php echo $allTask['contents'] ?></td>
                    <td><?php echo $allTask['deadline'] ?></td>
                    <td>
                        <?
                            $categoryId = $allTask['category_id'];
                            $stmt = $pdo->prepare('SELECT name FROM categories WHERE id = :id');
                            $stmt->execute([':id' => $categoryId]);
                            $category = $stmt->fetch(PDO::FETCH_ASSOC);
                            echo $category['name']; 
                        ?>
                    </td>
                    <td>
                        <form action="../process/task/updateStatus.php" method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $allTask['id']; ?>">
                            <input type="hidden" name="status" value="<?php echo $allTask['status']; ?>">
                            <button type="submit" name="toggle_status">
                                <?php echo ($allTask['status'] == 1) ? '完了' : '未完了'; ?>
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="task/edit.php?id=<?php echo $allTask['id']; ?>">編集</a>
                    </td>
                    <td>
                        <form action="../process/task/delete.php" method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $allTask['id']; ?>">
                            <button type="submit" name="delete">削除</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div>
            <?php echo $errorTaskDelete ?>
        </div>

    </div>
    
</body>
</html>
