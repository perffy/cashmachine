<?php

namespace App\Services;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class CashMashineService
{

    protected $request;
    protected $fields;
    protected $redirectUrl;

    public function __construct(Request $request, array $fields, string $redirectUrl)
    {
        $this->request = $request;
        $this->fields = $fields;
        $this->redirectUrl = $redirectUrl;
    }

    public function store(TransactionInterface $transaction)
    {
        $validator = $transaction->validate($this->request);

        if (is_bool($validator)) {

            $transactionRepo = new TransactionRepository(new Transaction());
            $amount = $transaction->amount($this->request->only($this->fields));

            $dbTransaction = $transactionRepo->store([
                'total' => $amount,
                'inputs' => $this->request->only($this->fields)
            ]);

            return redirect('/')->with('transaction', $transaction->inputs($dbTransaction));


        } else {
            return redirect($this->redirectUrl)
                ->withErrors($validator)
                ->withInput();
        }

    }
}
