<?php

namespace App\Interfaces;

use App\Models\Transaction;
use Illuminate\Http\Request;

interface TransactionInterface
{
    public function validate(Request $request);

    public function amount(array $data): int;

    public function inputs(Transaction $transaction): string;
}
