<?php


namespace Packages\Infrastructure\OuterServiceRepository\AlgoliaNews;

use Illuminate\Support\Facades\Http;
use Packages\Infrastructure\OuterServiceRepository\AlgoliaNews\Apis\GetNews;

class AlgoliaNewsRepository
{
    /** @var GetNews  */
    private $getNews;

    /**
     * AlgoliaNewsRepository constructor.
     */
    public function __construct(GetNews $getNews)
    {
        $this->getNews = $getNews;
    }

    // TODO:このあたりの外部APIの利用方法についてもうすこし深く考察する。
    public function searchNews(string $searchString)
    {
        return $this->getNews->execute($searchString);
    }
}
