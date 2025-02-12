<?php
namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class SearchPointsModel
{
    #[Assert\Length(
        min: 3,
        max: 64,
        minMessage: 'Street must be at least {{ limit }} characters long',
        maxMessage: 'Street cannot be longer than {{ limit }} characters',
    )]
    #[Assert\Expression(
        "(this.getZip() and this.getStreet()) or !this.getStreet()",
        message: 'If street is entered you must enter a valid zip code',
    )]
    private ?string $street = null;

    #[Assert\Length(
        min: 3,
        max: 64,
        minMessage: 'City must be at least {{ limit }} characters long',
        maxMessage: 'City cannot be longer than {{ limit }} characters',
    )]
    #[Assert\NotBlank]
    private string $city;

    #[Assert\Regex(
        pattern: '/^(\d{2}-\d{3})?$/',
        message: 'Zip must be in 00-000 format',
    )]
    private ?string $zip = null;

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): void
    {
        $this->zip = $zip;
    }
}