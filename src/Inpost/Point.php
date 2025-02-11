<?php
namespace App\Inpost;

class Point
{
    private int $count;

    private int $page;

    private int $totalPages;

    private array $pointItems;

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function setTotalPages(int $totalPages): void
    {
        $this->totalPages = $totalPages;
    }

    public function getPointItems(): array
    {
        return $this->pointItems;
    }

    public function setPointItems(array $pointItems): void
    {
        $this->pointItems = $pointItems;
    }
}