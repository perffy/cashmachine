<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public static function checkTotalSumOfTransactions()
    {
        return Transaction::sum('total');
    }

    public static function getMaximumSumForDeposit()
    {
        return config('settings.limit_total_transactions') - self::checkTotalSumOfTransactions();
    }
}
