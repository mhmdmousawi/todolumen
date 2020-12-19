<?php

namespace App\DTOFactories;

use App\DTOs\PaginatedDTO;

class PaginatedDTOFactory
{
    public function create(array $result, array $items): PaginatedDTO
    {
        return new PaginatedDTO(
            $result['current_page'],
            $items,
            $result['per_page'],
            $result['first_page_url'],
            $result['next_page_url'],
            $result['from'],
            $result['to'],
            $result['links'],
            $result['total']
        );
    }
}
