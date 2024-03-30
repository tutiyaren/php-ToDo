<?php
session_start();

use App\Task;
require '../../../app/Tasks.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

if(empty($_POST['categoryName'])) {
    $_SESSION['errorUpdateTask'] = 'カテゴリが選択されていません';
    header('Location: /../task/edit.php?id=' . $_POST['task_id']);
    exit();
}
if(empty($_POST['contents'])) {
    $_SESSION['errorUpdateTask'] = 'タスク名が入力されていません';
    header('Location: /../task/edit.php?id=' . $_POST['task_id']);
    exit();
}
if(empty($_POST['deadline'])) {
    $_SESSION['errorUpdateTask'] = '締切日が入力されていません';
    header('Location: /../task/edit.php?id=' . $_POST['task_id']);
    exit();
}

$userId = $_SESSION['id'];
$category_id = $_POST['categoryName'];
$contents = $_POST['contents'];
$deadline = $_POST['deadline'];
$taskModel = new Task($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $task_id = $_POST['task_id'];
    $taskModel->updateTask($task_id, $category_id, $contents, $deadline);
    header('Location: /index.php');
    exit();
}
