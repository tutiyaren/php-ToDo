<?php
session_start();

use App\Task;
require_once '../../../app/Tasks.php';


if (!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status']))) {
    header('Location: /index.php');
    exit();
}

$taskId = $_POST['task_id'];
$newStatus = ($_POST['status'] == 0) ? 1 : 0;
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password'); 
$taskModel = new Task($pdo); 
$taskModel->toggleStatus($newStatus, $taskId);