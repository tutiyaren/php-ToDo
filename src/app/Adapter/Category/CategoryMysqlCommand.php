<?php
namespace App\Adapter\Category;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\CategoryDao;
use App\Domain\ValueObject\Category\NewCategory;
use App\Domain\ValueObject\Category;

class CategoryMysqlCommand
{
    private $categoryDao;

    public function __construct()
    {
        $this->categoryDao = new CategoryDao();
    }

    public function insert(NewCategory $category): void
    {
        $this->categoryDao->create($category);
    }
}
