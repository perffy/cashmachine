<?php

namespace App\Services;

use App\Interfaces\TransactionInterface;
use Illuminate\Http\Request;
use Validator;

class BankTransferService implements TransactionInterface
{

    public function validate(Request $request)
    {
        $fields = [
            'transferDate',
            'customerName',
            'accountNumber',
            'amount',
        ];

        $validator = Validator::make($request->all(), [
            'transferDate' => 'required|date|after:yesterday',
            'customerName' => 'required|regex:/^[a-zA-Z ]+$/u|max:100',
            'accountNumber' => 'required|digits:6',
            'amount' => 'required|integer|min:1',
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
