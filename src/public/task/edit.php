<?php
require_once '../common/auth.php';
require '../../app/Tasks.php';
require '../../app/Categories.php';
use App\Task;
use App\Category;
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

$taskModel = new Task($pdo);
$taskId = $_GET['id'];
$task = $taskModel->getTask($taskId);

$categoryModel = new Category($pdo);
$allCategories = $categoryModel->getCategories($userId);

$errorUpdateTask = '';
if (isset($_SESSION['errorUpdateTask'])) {
    $errorUpdateTask = $_SESSION['errorUpdateTask'];
    unset($_SESSION['errorUpdateTask']);
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
                <select name="categoryName">
                    <?php foreach($allCategories as $allCategory): ?>
                        <?php if ($allCategory['id'] === $task['category_id']): ?>
                            <option value="<?php echo $allCategory['id']; ?>" selected><?php echo $allCategory['name']; ?></option>
                        <?php endif; ?>
                        <?php if (!($allCategory['id'] === $task['category_id'])): ?>
                            <option value="<?php echo $allCategory['id']; ?>"><?php echo $allCategory['name']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <input type="text" name="contents" placeholder="タスクを追加" value="<?php echo $task['contents']; ?>">
            </div>
            <div>
                <input type="date" name="deadline" value="<?php echo $task['deadline']; ?>" min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div>
                <input type="hidden" name="task_id" value="<?php echo $task['id'] ?>">
                <button type="submit" name="update">更新</button>
            </div>
        </form>

        <div>
            <?php echo $errorUpdateTask; ?>
        </div>

        <!-- ホームリンク -->
        <div>
            <a href="../index.php">戻る</a>
        </div>
    </div>
    
</body>
</html>
