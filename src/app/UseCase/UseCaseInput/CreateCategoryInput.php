<?php
namespace App\UseCase\UseCaseInput;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Category\CategoryId;
use App\Domain\ValueObject\Category\CategoryUserId;
use App\Domain\ValueObject\Category\CategoryName;

final class CreateCategoryInput
{
    private $user_id;
    private $name;

    public function __construct(CategoryUserId $user_id, CategoryName $name)
    {
        
        $this->user_id = $user_id;
        $this->name = $name;
    }

    public function user_id(){
        return $this->user_id;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }
}