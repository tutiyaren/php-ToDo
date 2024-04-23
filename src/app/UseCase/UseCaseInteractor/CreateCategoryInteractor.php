<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\CategoryQueryServise;
use App\Adapter\Repository\CategoryRepository;
use App\UseCase\UseCaseInput\CreateCategoryInput;
use App\UseCase\UseCaseOutput\CreateCategoryOutput;
use App\Domain\ValueObject\Category\NewCategory;
use App\Domain\Entity\Category;
use App\Adapter\Category\CategoryMysqlCommand;
use App\Adapter\Category\CategoryMysqlQuery;

final class CreateCategoryInteractor
{
    const COMPLETED_MESSAGE = 'カテゴリーを追加しました';
    private $input;
    private $categoryMysqlCommand;
    private $categoryMysqlQuery;

    public function __construct(
        CreateCategoryInput $input,
        CategoryMysqlQuery $categoryMysqlQuery,
        CategoryMysqlCommand $categoryMysqlCommand
    )
    {
        $this->input = $input;
        $this->categoryMysqlCommand = $categoryMysqlCommand;
        $this->categoryMysqlQuery = $categoryMysqlQuery;
    }

    public function run(): CreateCategoryOutput
    {
        if(strlen($this->input->name()->value()) > 20) {
            return new CreateCategoryOutput(false, 'カテゴリ名は20文字以内でお願い');
        }
        $this->createCategory();
        return new CreateCategoryOutput(true, self::COMPLETED_MESSAGE);
    }

    public function createCategory(): void
    {
        $this->categoryMysqlCommand->insert(
            new NewCategory(
                $this->input->user_id(),
                $this->input->name()
            )
        );
    }
}
