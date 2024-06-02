<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Task\TaskUserId;
use App\Domain\ValueObject\Task\TaskCategoryId;
use App\Domain\ValueObject\Task\TaskStatus;
use App\Domain\ValueObject\Task\TaskDeadline;
use App\Domain\ValueObject\Task\TaskContents;
use App\UseCase\UseCaseInput\CreateTaskInput;
use App\UseCase\UseCaseInteractor\CreateTaskInteractor;
use APp\UseCase\UseCaseOutput\CreateTaskOutput;
use App\Adapter\Task\TaskMysqlCommand;
use App\Adapter\Task\TaskMysqlQuery;

$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

$categoryName = $_POST['categoryName'];
$stmt = $pdo->prepare('SELECT id FROM categories WHERE name = :name');
$stmt->execute([':name' => $categoryName]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);
$categoryName = filter_input(INPUT_POST, 'categoryName');
$taskDeadline = filter_input(INPUT_POST, 'deadline');
$taskContents = filter_input(INPUT_POST, 'contents');
$taskStatus = 0;

try {
    session_start();
    if(empty($taskContents) || empty($categoryName) || empty($taskDeadline)) {
        throw new Exception('タスク名、カテゴリー、日付を入力して');
    }
    $user_id = $_SESSION['id'];
    $category_id = $category['id'];
    $taskUserId = new TaskUserId($user_id);
    $taskCategoryId = new TaskCategoryId($category_id);
    $deadline = new TaskDeadline($taskDeadline);
    $contents = new TaskContents($taskContents);
    $status = new TaskStatus($taskStatus);
    $useCaseInput = new CreateTaskInput($taskUserId, $taskCategoryId, $status, $deadline, $contents);
    $taskMysqlQuery = new TaskMysqlQuery();
    $taskMysqlCommand = new TaskMysqlCommand();
    $useCase = new CreateTaskInteractor($useCaseInput, $taskMysqlQuery, $taskMysqlCommand);
    $useCaseOutput = $useCase->run();

    if(!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::hendler('/index.php');
} catch(Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['contents'] = $taskContents;
    Redirect::hendler('/task/create.php');
}

// session_start();
// use App\Task;
// require '../../../app/Tasks.php';
// $pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');
// if(empty($_POST['categoryName']) || empty($_POST['contents']) || empty($_POST['deadline'])) {
//     Task::validateTask();
// }
// $categoryName = $_POST['categoryName'];
// $stmt = $pdo->prepare('SELECT id FROM categories WHERE name = :name');
// $stmt->execute([':name' => $categoryName]);
// $category = $stmt->fetch(PDO::FETCH_ASSOC);
// $categoryId = $category['id'];

// $userId = $_SESSION['id'];
// $status = 0;
// $contents = $_POST['contents'];
// $deadline = $_POST['deadline'];
// $taskModel = new Task($pdo);
// $createTask = $taskModel->addTask($userId, $categoryId, $status, $contents, $deadline);
// if($createTask !== false) {
//     header('Location: /../index.php');
//     exit();
// }