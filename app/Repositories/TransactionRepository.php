<?php

namespace App\Repositories;

use App\Models\Transaction;
use DB;

class TransactionRepository
{
    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    public function store(array $data = []): Transaction
    {
        DB::beginTransaction();
        try {
            $transaction = $this->model::create([
                'total' => $data['total'],
                'inputs' => json_encode($data['inputs']),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();
        return $transaction;
    }
}
