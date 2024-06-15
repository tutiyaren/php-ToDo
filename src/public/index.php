<?php
session_start();
ob_start();
require '../app/Tasks.php';
require '../app/Categories.php';
use App\Task;



if(!isset($_SESSION['id'])) {
    header('Location: /user/signin.php');
}
$userId = $_SESSION['id'];


use App\Category;
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

$errorTaskDelete = '';
if (isset($_SESSION['errorDeleteTask'])) {
    $errorTaskDelete = $_SESSION['errorDeleteTask'];
    unset($_SESSION['errorDeleteTask']);
}

$categoryModel = new Category($pdo);
$allCategories = $categoryModel->getCategories($userId);


$taskModel = new Task($pdo);
$searchKeyword = isset($_GET['contents']) ? $_GET['contents'] : '';
$orderBy = isset($_GET['sort']) ? $_GET['sort'] : '';
$categoryName = isset($_GET['categoryName']) ? $_GET['categoryName'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$allTasks = $taskModel->searchTasks($userId, $searchKeyword, $orderBy, $categoryName, $status);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDoアプリ</title>
  <link rel="stylesheet" href="./css/click.css">
</head>
<body>

    <?php include 'header/header.php'; ?>

    <div>
        <!-- 絞り込み -->
        <div>
            <h1>絞り込み機能</h1>
            <form method="GET">
                <div style="display: flex;">
                    <input type="text" name="contents" placeholder="キーワードを入力" value="<?php echo htmlspecialchars(
                        $searchKeyword,
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>">
                    <div>
                        <div>
                            <input type="radio" name="sort" id="newCreated" value="new" <?php echo $orderBy === 'new' ? 'checked' : ''; ?>>
                            <label for="newCreated">新着順</label>
                        </div>
                        <div>
                            <input type="radio" name="sort" id="oldCreated" value="old" <?php echo $orderBy === 'old' ? 'checked' : ''; ?>>
                            <label for="oldCreated">古い順</label>
                        </div>
                    </div>
                    <div>
                        <select name="categoryName">
                            <option value="" disabled selected>カテゴリを選んでください</option>
                            <?php foreach ($allCategories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>" <?php echo $categoryName === $category['name'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <div>
                            <input type="radio" name="status" id="completed" value="1" <?php echo $status === '1' ? 'checked' : ''; ?>>
                            <label for="completed">完了</label>
                        </div>
                        <div>
                            <input type="radio" name="status" id="incomplete" value="0" <?php echo $status === '0' ? 'checked' : ''; ?>>
                            <label for="incomplete">未完了</label>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" name="search">検索</button>
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
            <?php foreach ($allTasks as $task): ?>
                <tr class="task-list">
                    <td><?php echo htmlspecialchars($task['contents'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($task['deadline'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($task['category_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <form action="../process/task/updateStatus.php" method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <input type="hidden" name="status" value="<?php echo $task['status']; ?>">
                            <button type="submit" name="toggle_status">
                                <?php echo $task['status'] == 1 ? '完了' : '未完了'; ?>
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="task/edit.php?id=<?php echo $task[
                            'id'
                        ]; ?>">編集</a>
                    </td>
                    <td>
                        <form action="../process/task/delete.php" method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $task[
                                'id'
                            ]; ?>">
                            <button type="submit" name="delete">削除</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div>
            <?php echo $errorTaskDelete; ?>
        </div>

    </div>
    
<script src="./js/click.js"></script>
</body>
</html>
