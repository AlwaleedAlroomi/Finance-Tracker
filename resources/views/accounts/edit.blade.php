@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/create_account.css') }}">
@endsection
@section('content')
    <div class="form-container">
        <form action="{{ route('accounts.update', $account) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="acc_name">Account Name</label>
                <input type="text" name="acc_name" id="acc_name" value="{{ $account->acc_name }}">
            </div>
            <div class="form-group">
                <label for="amount">Initial Amount</label>
                <input type="number" name="amount" id="amount" value="{{ $account->amount }}">
            </div>
            <div class="form-group">
                <input id="subBtn" type="submit" value="Update Account">
            </div>
        </form>
    </div>
@endsection
