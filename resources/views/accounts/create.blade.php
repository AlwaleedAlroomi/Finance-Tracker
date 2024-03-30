@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/create_account.css') }}">
@endsection
@section('alert')
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endsection

@section('content')
    <div class="form-container">
        <form action="{{ route('accounts.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="acc_name">Account Name</label>
                <input type="text" name="acc_name" id="acc_name">
            </div>
            <div class="form-group">
                <label for="amount">Initial Amount</label>
                <input type="number" name="amount" id="amount">
            </div>
            <div class="form-group">
                <input id="subBtn" type="submit" value="Create Account">
            </div>
        </form>
    </div>
@endsection
