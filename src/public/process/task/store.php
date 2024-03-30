<?php
session_start();

use App\Task;
require '../../../app/Tasks.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

if(empty($_POST['categoryName']) || empty($_POST['contents']) || empty($_POST['deadline'])) {
    Task::validateTask();
}

$categoryName = $_POST['categoryName'];
$stmt = $pdo->prepare('SELECT id FROM categories WHERE name = :name');
$stmt->execute([':name' => $categoryName]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);
$categoryId = $category['id'];

$userId = $_SESSION['id'];
$status = 0;
$contents = $_POST['contents'];
$deadline = $_POST['deadline'];
$taskModel = new Task($pdo);
$createTask = $taskModel->addTask($userId, $categoryId, $status, $contents, $deadline);
if($createTask !== false) {
    header('Location: /../index.php');
    exit();
}