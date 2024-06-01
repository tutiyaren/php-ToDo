<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Category\CategoryId;
use App\Domain\ValueObject\Category\CategoryUserId;
use App\Domain\ValueObject\Category\CategoryName;
use App\UseCase\UseCaseInput\CreateCategoryInput;
use App\UseCase\UseCaseInteractor\CreateCategoryInteractor;
use App\UseCase\UseCaseOutput\CreateCategoryOutput;
use App\Adapter\Category\CategoryMysqlCommand;
use App\Adapter\Category\CategoryMysqlQuery;

$name = filter_input(INPUT_POST, 'name');

try {
    session_start();
    if(empty($name)) {
        throw new Exception('カテゴリーを入力して');
    }
    $user_id = $_SESSION['id'];
    $categoryUserId = new CategoryUserId($user_id);
    $categoryName = new CategoryName($name);
    $useCaseInput = new CreateCategoryInput($categoryUserId, $categoryName);
    $categoryMysqlQuery = new CategoryMysqlQuery();
    $categoryMysqlCommand = new CategoryMysqlCommand();
    $useCase = new CreateCategoryInteractor($useCaseInput, $categoryMysqlQuery, $categoryMysqlCommand);
    $useCaseOutput = $useCase->run();
    if(!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::hendler('/category/index.php');
} catch(Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['user']['name'] = $name;
    Redirect::hendler('/category/index.php');
}


// session_start();
// use App\Category;
// require '../../../app/Categories.php';
// $pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');
// if(empty(htmlspecialchars($_POST['name']))) {
//     Category::validateCategory();
// }
// $userId = $_SESSION['id'];
// $name = $_POST['name'];
// $categoyModel = new Category($pdo);
// $createCategory = $categoyModel->addCategory($userId, $name);
// if($createCategory !== false) {
//     header('Location: /../category/index.php');
//     exit();
// }
