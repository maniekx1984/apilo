<?php
namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Step\Then;
use Behat\Step\When;
use App\Service\FetchDataFromInpost;
use App\Inpost\Point;
use PHPUnit\Framework\Assert;
use Symfony\Component\Serializer\SerializerInterface;

class InpostContext implements Context
{
    private ?Point $apiData = null;

    public function __construct(
        private readonly FetchDataFromInpost $fetchDataFromInpost,
        private readonly SerializerInterface $serializer,
    ) {
    }

    #[When('I use service FetchDataFromImport with scope :scope and city :city')]
    public function iUseServiceFetchDataFromImportWithScopeAndCity(string $scope, string $city): void
    {
        $this->apiData = $this->fetchDataFromInpost->fetchData($scope, $city);
    }

    #[Then('The results should contains sample result data')]
    public function theResultsShouldContain(): void
    {
        Assert::assertEquals(1, $this->apiData->getPage());
        Assert::assertEquals(13, $this->apiData->getCount());
        Assert::assertEquals(1, $this->apiData->getTotalPages());
        $json = $this->serializer->serialize($this->apiData, 'json');
        Assert::assertJson($json);
        Assert::assertStringContainsString('KZY01A', $json);
    }
}