<?php

declare(strict_types=1);

namespace App\Grid\Provider;

use App\Model\User;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Context\Option\RequestOption;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProviderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Webmozart\Assert\Assert;

final class UserProvider implements ProviderInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly HttpClientInterface $dummyjsonClient,
    ) {
    }

    public function provide(Operation $operation, Context $context): object|iterable|null
    {
        $request = $context->get(RequestOption::class)?->request();

        Assert::notNull($request);

        $response = $this->dummyjsonClient->request('GET', '/users/' . $request->attributes->get('id'));

        return $this->serializer->denormalize($response->toArray(), User::class);
    }
}
