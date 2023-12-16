@if (session('transaction'))
    <div class="col-md-12 mb-12">
        <p class="card-text">Transaction successfully submitted. Here are the details:</p>
        {!! formatTransaction(session('transaction')) !!}
        </p>
    </div>
@endif
