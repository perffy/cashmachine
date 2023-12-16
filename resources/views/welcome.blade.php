@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- First Div -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-wallet"></i>
                    <h5 class="card-title">Cash source</h5>
                    <p class="card-text">This is some sample text for the first div.</p>
                    <a href="{{ route('deposits.cash') }}" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>

        <!-- Second Div -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-credit-card"></i>
                    <h5 class="card-title">Credit card source</h5>
                    <p class="card-text">This is some sample text for the second div.</p>
                    <a href="{{ route('deposits.creditcard') }}" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>

        <!-- Third Div -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-server"></i>
                    <h5 class="card-title">Bank transfer source</h5>
                    <p class="card-text">This is some sample text for the third div.</p>
                    <a href="{{ route('deposits.banktransfer') }}" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>

        @if (session('transaction'))
            <div class="col-md-12 mb-12">
                <p class="card-text">Transaction successfully submitted. Here are the details:</p>
                {!! session('transaction') !!}
                </p>
            </div>
        @endif

    </div>
@endsection
