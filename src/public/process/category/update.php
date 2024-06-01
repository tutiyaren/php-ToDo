<?php
session_start();

use App\Category;
require '../../../app/Categories.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

if(empty($_POST['name'])) {
    $_SESSION['errorUpdateCategory'] = 'カテゴリ名が入力されていません';
    header('Location: /../category/edit.php?id=' . $_POST['category_id']);
    exit();
}

$userId = $_SESSION['id'];
$name = $_POST['name'];
$categoryModel = new Category($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $category_id = $_POST['category_id'];
    $categoryModel->updateCategory($category_id, $name);
    header('Location: /../category/index.php');
    exit();
}
