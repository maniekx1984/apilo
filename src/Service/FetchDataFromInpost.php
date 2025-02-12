<?php
namespace App\Service;

use App\Exception\InpostApiException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Inpost\Point;

readonly class FetchDataFromInpost {
    public function __construct(
        private HttpClientInterface $client,
        private SerializerInterface $serializer,
    ) {
    }

    public function fetchData(
        string $scope,
        string $city,
    ): Point
    {
        $response = $this->client->request(
            'GET',
            sprintf('https://api-shipx-pl.easypack24.net/v1/%s?city=%s', $scope, $city),
        );
        if (200 !== $response->getStatusCode()) {
            throw new InpostApiException(
                sprintf('Error fetching data from inpost - status code: %s', $response->getStatusCode()),
            );
        }
        if ('application/json' !== $response->getHeaders()['content-type'][0]) {
            throw new InpostApiException(
                sprintf('Error fetching data from inpost - content type: %s', $response->getHeaders()['content-type'][0]),
            );
        }

        return $this->serializer->deserialize($response->getContent(), Point::class, 'json');
    }
}