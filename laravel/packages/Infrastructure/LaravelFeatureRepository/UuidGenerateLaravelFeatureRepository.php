<?php


namespace Packages\Infrastructure\LaravelFeatureRepository;

use Packages\Domain\CommonRepository\UuidGeneratorInterface;
use Illuminate\Support\Str;

class UuidGenerateLaravelFeatureRepository implements UuidGeneratorInterface
{

    public function generateUuidString(): string
    {
        return Str::orderedUuid()->toString();
    }
}
