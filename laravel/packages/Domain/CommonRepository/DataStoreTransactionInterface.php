<?php

namespace Packages\Domain\CommonRepository;

use Illuminate\Support\Facades\DB;

use Closure;

/**
 * Interface DataStoreTransactionInterface
 * トランザクション処理にまつわるDB処理のインターフェース
 *
 * @package Packages\Domain\CommonRepository
 */
interface DataStoreTransactionInterface
{
    /**
     * @param Closure $transactionFunction
     * @return mixed
     */
    public function startTransaction(Closure $transactionFunction);
}
