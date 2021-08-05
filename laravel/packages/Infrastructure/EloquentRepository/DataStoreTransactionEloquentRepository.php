<?php

namespace Packages\Infrastructure\EloquentRepository;

use Closure;
use Illuminate\Support\Facades\DB;
use Packages\Domain\CommonRepository\DataStoreTransactionInterface;
use RuntimeException;

class DataStoreTransactionEloquentRepository implements DataStoreTransactionInterface
{

    public function startTransaction(Closure $transactionFunction)
    {
        $response = null;
        DB::beginTransaction();
        try {
            $response = $transactionFunction();
            DB::commit();
        } catch (RuntimeException $e) {
            report($e);
            DB::rollBack();
        }

        return $response;
    }
}
