<?php

declare(strict_types=1);

namespace App\Grid\Provider;

use App\Model\User;
use Pagerfanta\Adapter\FixedAdapter;
use Pagerfanta\Pagerfanta;
use Sylius\Component\Grid\Data\DataProviderInterface;
use Sylius\Component\Grid\Definition\Grid;
use Sylius\Component\Grid\Parameters;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class UserGridDataProvider implements DataProviderInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly HttpClientInterface $dummyjsonClient,
    ) {
    }

    public function getData(Grid $grid, Parameters $parameters): Pagerfanta
    {
        $limit = $parameters->get('limit', 10);
        $page = $parameters->get('page', 1);

        $response = $this->dummyjsonClient->request('GET', '/users', [
            'query' => [
                'limit' => $limit,
                'skip' => ($page - 1) * $limit,
            ]
        ]);

        return new Pagerfanta(new FixedAdapter(
            (int) $response->toArray()['total'],
            $this->serializer->denormalize($response->toArray()['users'], User::class . '[]')
        ));
    }
}
