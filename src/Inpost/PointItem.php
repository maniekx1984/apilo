<?php
namespace App\Inpost;

class PointItem {

    private string $name;

    private array $addresses;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAddresses(): array
    {
        return $this->array;
    }

    public function setAddresses(array $addresses): void
    {
        $this->addresses = $addresses;
    }
}