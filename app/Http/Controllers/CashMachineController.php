<?php

namespace App\Http\Controllers;

use App\Services\BankTransferService;
use App\Services\CashMashineService;
use App\Services\CashService;
use App\Services\CreditCardService;
use Illuminate\Http\Request;

class CashMachineController extends Controller
{

    public function form_cash()
    {
        return view('deposits.cash');
    }

    public function store_cash(Request $request)
    {
        $fields = [
            'banknote_1',
            'banknote_5',
            'banknote_10',
            'banknote_50',
            'banknote_100',
        ];

        $url = 'deposits/cash';

        $service = new CashMashineService($request, $fields, $url);
        $cashService = new CashService();

        return $service->store($cashService);

    }

    public function form_credit_card()
    {
        return view('deposits.credit-card')
            ->withMonths(getMonths())
            ->withYears(getYears());
    }

    public function store_credit_card(Request $request)
    {
        $fields = [
            'creditCardNumber',
            'month',
            'year',
            'cvv',
            'cardholderName',
            'amount',
        ];

        $url = 'deposits/credit-card';

        $service = new CashMashineService($request, $fields, $url);
        $cardService = new CreditCardService();

        return $service->store($cardService);
    }

    public function form_bank_transfer()
    {
        return view('deposits.bank-transfer');
    }

    public function store_bank_transfer(Request $request)
    {
        $fields = [
            'transferDate',
            'customerName',
            'accountNumber',
            'amount',
        ];

        $url = 'deposits/bank-transfer';

        $service = new CashMashineService($request, $fields, $url);
        $bankService = new BankTransferService();

        return $service->store($bankService);
    }
}
