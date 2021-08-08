<?php


namespace Packages\Infrastructure\OuterServiceRepository\AlgoliaNews\Apis;

use Illuminate\Support\Facades\Http;

final class GetNews extends BaseRequest
{
    private const ENDPOINT = self::BASE_URI . 'search';

    public function execute(string $searchString)
    {
        return Http::get(self::ENDPOINT, [
            'query' => $searchString,
        ])->json();
    }
}
