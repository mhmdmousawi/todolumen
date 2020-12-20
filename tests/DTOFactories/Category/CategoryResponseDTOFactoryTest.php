<?php

namespace DTOFactories\Category;

use App\DTOFactories\Category\CategoryResponseDTOFactory;
use App\DTOs\Category\CategoryResponseDTO;
use App\Models\Category;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class CategoryResponseDTOFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testCreate(): void
    {
        $categoryResponseDTOFactory = new CategoryResponseDTOFactory();
        $category = new Category();
        $category->id = 1;
        $category->name = 'name';

        $this->assertInstanceOf(
            CategoryResponseDTO::class,
            $categoryResponseDTOFactory->create($category)
        );
    }
}
