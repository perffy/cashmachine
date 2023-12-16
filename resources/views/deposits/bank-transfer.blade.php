@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Bank transfer deposit</h1>
            <br>
            {{ html()->modelForm(null, 'post', route('deposits.banktransfer.store'))->open() }}
            <!-- Transfer date -->
            <div class="mb-3">
                <label for="transferDate" class="form-label">Transfer date:</label>
                {{ html()->date('transferDate')->value(old('transferDate'))->class('form-control')->placeholder(__('Transfer date')) }}
            </div>

            <!-- Customer Name -->
            <div class="mb-3">
                <label for="customerName" class="form-label">Customer Name:</label>
                {{ html()->text('customerName')->value(old('customerName'))->class('form-control')->placeholder(__('Customer Name')) }}
            </div>

            <!-- Account Number -->
            <div class="mb-3">
                <label for="accountNumber" class="form-label">Account Number:</label>
                {{ html()->text('accountNumber')->value(old('accountNumber'))->class('form-control')->placeholder(__('Account Number')) }}
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
