<?php
session_start();

use App\Task;
require '../../../app/Tasks.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

$userId = $_SESSION['id'];
$taskModel = new Task($pdo);

if(!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']))) {
    header('Location: /index.php');
    exit();
}

$task_id = $_POST['task_id'];
$taskModel->deleteTask($task_id);
header('Location: /index.php');
exit();