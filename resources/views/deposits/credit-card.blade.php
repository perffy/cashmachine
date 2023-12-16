@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h1>Credit card deposit</h1>
        <br>
        {{ html()->modelForm(null, 'post', route('deposits.creditcard.store'))->open() }}
            <!-- Credit Card Number -->
            <div class="mb-3">
                <label for="creditCardNumber" class="form-label">Credit Card Number:</label>
                {{ html()->number('creditCardNumber')->value(old('creditCardNumber'))->class('form-control')->placeholder(__('**** **** **** ****')) }}
            </div>

            <!-- Expiry Date and CVV -->
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="month" class="form-label">Expiry month:</label>
                        {{ html()->select('month', $months)->value(old('month'))->class('form-control') }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="year" class="form-label">Expiry year:</label>
                        {{ html()->select('year', $years)->value(old('year'))->class('form-control') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV:</label>
                        {{ html()->text('cvv')->value(old('cvv'))->class('form-control')->placeholder(__('CVV')) }}
                    </div>
                </div>
            </div>

            <!-- Cardholder Name -->
            <div class="mb-3">
                <label for="cardholderName" class="form-label">Cardholder Name:</label>
                {{ html()->text('cardholderName')->value(old('cardholderName'))->class('form-control')->placeholder(__('Cardholder Name')) }}
            </div>

            <!-- Amount -->
            <div class="mb-3">
                <label for="amount" class="form-label">Amount:</label>
                {{ html()->number('amount')->value(old('amount'))->class('form-control')->placeholder(__('Amount')) }}
            </div>

            @include('deposits.partials.errors')

            <!-- Submit Button -->
            <input type="hidden" name="expiration">
            <button type="submit" class="btn btn-primary">Deposit</button>
        </form>
    </div>
</div>

@endsection
