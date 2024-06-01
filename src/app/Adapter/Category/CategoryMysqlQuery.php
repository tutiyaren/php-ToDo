<?php
namespace App\Adapter\Category;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\CategoryDao;

class CategoryMysqlQuery
{
    private $categoryDao;

    public function __construct()
    {
        $this->categoryDao = new CategoryDao();
    }
}
