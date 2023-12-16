@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h1>Cash deposit</h1>
        <br>
        {{ html()->modelForm(null, 'post', route('deposits.cash.store'))->open() }}
            <!-- Text Input Fields -->
            <div class="mb-3">
                <label for="banknote_1" class="form-label">Banknote $1:</label>
                {{ html()->number('banknote_1')->value(old('banknote_1'))->class('form-control')->placeholder(__('Banknote 1')) }}
            </div>

            <div class="mb-3">
                <label for="banknote_5" class="form-label">Banknote $5:</label>
                {{ html()->number('banknote_5')->value(old('banknote_5'))->class('form-control')->placeholder(__('Banknote 5')) }}
            </div>

            <div class="mb-3">
                <label for="banknote_10" class="form-label">Banknote $10:</label>
                {{ html()->number('banknote_10')->value(old('banknote_10'))->class('form-control')->placeholder(__('Banknote 10')) }}
            </div>

            <div class="mb-3">
                <label for="banknote_50" class="form-label">Banknote $50:</label>
                {{ html()->number('banknote_50')->value(old('banknote_50'))->class('form-control')->placeholder(__('Banknote 50')) }}
            </div>

            <div class="mb-3">
                <label for="banknote_100" class="form-label">Banknote $100:</label>
                {{ html()->number('banknote_100')->value(old('banknote_100'))->class('form-control')->placeholder(__('Banknote 100')) }}
            </div>

            @include('deposits.partials.errors')

            <!-- Submit Button -->
            <input type="hidden" name="total">
            <button type="submit" class="btn btn-primary">Deposit</button>
        </form>
    </div>
</div>

@endsection
