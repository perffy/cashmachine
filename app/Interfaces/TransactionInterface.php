<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface TransactionInterface
{
    public function validate(Request $request);

    public function amount(array $data): int;

    public function inputs();
}
