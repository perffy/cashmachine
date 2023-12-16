<?php

namespace App\Services;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;

class CreditCardService implements TransactionInterface
{

    public function validate(Request $request)
    {
        $fields = [
            'creditCardNumber',
            'expiryDate',
            'year',
            'month',
            'cardholderName',
            'amount',
        ];

        $minMonths = config('settings.min_months_validation');

        $validator = Validator::make($request->all(), [
            'creditCardNumber' => 'required|digits:16|starts_with:4',
            'year' => 'required|digits:4',
            'month' => 'required|digits:2',
            'cvv' => 'required|digits:3',
            'cardholderName' => 'required|regex:/^[a-zA-Z ]+$/u|max:100',
            'amount' => 'required|integer|min:1',
            'expiration' => 'expiration_min:'.$minMonths.',month,year'
        ]);

        $validator->after(function ($validator) use($request, $fields) {
            $amount = $this->amount($request->only($fields));
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
        return (int) $data['amount'];
    }

    public function inputs(Transaction $transaction): string
    {
        return "ID: ".$transaction->id."<br>Total: ".$transaction->total."<br>Input: ".$transaction->inputs;
    }

    public function exceedsTotalAmountOfTransactions(int $amount)
    {
        $totalSaved = TransactionService::checkTotalSumOfTransactions();
        return config('settings.limit_total_transactions') >= $totalSaved + $amount;
    }
}
