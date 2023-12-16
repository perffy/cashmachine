<?php

namespace App\Services;

use App\Interfaces\TransactionInterface;
use Illuminate\Http\Request;
use Validator;

class CashService implements TransactionInterface
{

    public function validate(Request $request)
    {
        $fields = [
            'banknote_1',
            'banknote_5',
            'banknote_10',
            'banknote_50',
            'banknote_100',
        ];

        $total = config('settings.limit_cash_transaction');

        $validator = Validator::make($request->all(), [
            'banknote_1' => 'required|integer|min:0',
            'banknote_5' => 'required|integer|min:0',
            'banknote_10' => 'required|integer|min:0',
            'banknote_50' => 'required|integer|min:0',
            'banknote_100' => 'required|integer|min:0',
            'total' => 'total_sum:'.$total.','.implode(',', $fields),
        ]);

        $validator->after(function ($validator) use($request, $fields) {
            $amount = $this->amount($request->only($fields));
            if ($amount <= 0) {
                $validator->errors()->add(
                    'entered_amount', trans('validation.min_deposit_amount')
                );
            }
            if (!$this->exceedsTotalAmountOfTransactions($amount)) {
                $validator->errors()->add(
                    'total_amount', trans('validation.total_available', [
                        'max' => TransactionService::getMaximumSumForDeposit(),
                        'limit' => config('settings.limit_total_transactions')
                    ])
                );
            }
        });

        if ($validator->fails()) {
            return $validator;
        }

        return true;
    }

    public function amount(array $data): int
    {
        $amount = 0;

        foreach ($data as $key => $value) {

            $multiplier = explode("_", $key);
            $amount += $data[$key] ? $data[$key] * (int) $multiplier[1] : 0;

        }

        return $amount;
    }

    public function inputs()
    {
        // TODO: Implement inputs() method.
    }

    public function exceedsTotalAmountOfTransactions(int $amount)
    {
        $totalSaved = TransactionService::checkTotalSumOfTransactions();
        return config('settings.limit_total_transactions') >= $totalSaved + $amount;
    }
}
