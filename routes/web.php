<?php

use App\Http\Controllers\CashMachineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('deposits/cash', [CashMachineController::class, 'form_cash'])->name('deposits.cash');
Route::post('deposits/cash', [CashMachineController::class, 'store_cash'])->name('deposits.cash.store');

Route::get('deposits/credit-card', [CashMachineController::class, 'form_credit_card'])->name('deposits.creditcard');
Route::post('deposits/credit-card', [CashMachineController::class, 'store_credit_card'])->name('deposits.creditcard.store');

Route::get('deposits/bank-transfer', [CashMachineController::class, 'form_bank_transfer'])->name('deposits.banktransfer');
Route::post('deposits/bank-transfer', [CashMachineController::class, 'store_bank_transfer'])->name('deposits.banktransfer.store');
