<?php

namespace App\DTOs;

class PaginatedDTO
{
    /**
     * @var int|null
     */
    public $currentPage;

    /**
     * @var array
     */
    public $items;

    /**
     * @var int|null
     */
    public $perPage;

    /**
     * @var string|null
     */
    public $firstPageURL;

    /**
     * @var string|null
     */
    public $nextPageURL;

    /**
     * @var int|null
     */
    public $from;

    /**
     * @var int|null
     */
    public $to;

    /**
     * @var array|null
     */
    public $links;

    /**
     * @var int
     */
    public $total;

    public function __construct(
        ?int $currentPage,
        array $items,
        ?int $perPage,
        ?string $firstPageURL,
        ?string $nextPageURL,
        ?int $from,
        ?int $to,
        array $links,
        int $total
    ) {
        $this->currentPage = $currentPage;
        $this->items = $items;
        $this->perPage = $perPage;
        $this->firstPageURL = $firstPageURL;
        $this->nextPageURL = $nextPageURL;
        $this->from = $from;
        $this->to = $to;
        $this->links = $links;
        $this->total = $total;
    }
}
