<?php

namespace DTOFactories\Category;

use App\DTOFactories\Category\CategoryRequestDTOFactory;
use App\DTOs\Category\CategoryRequestDTO;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CategoryRequestDTOFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $categoryRequestDTOFactory = new CategoryRequestDTOFactory();
        $request = new Request();
        $request->initialize(['name' => 'name']);

        $this->assertInstanceOf(
            CategoryRequestDTO::class,
            $categoryRequestDTOFactory->create($request)
        );
    }
}
