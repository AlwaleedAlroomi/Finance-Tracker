@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/show_acc.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="btn">
            <a class="edit" href="{{ route('accounts.edit', $account) }}">Edit Account</a>
            <a class="delete" href="{{ route('accounts.delete', $account) }}"
                onclick="return confirm('Do you want to delete this product?');">Delete Account</a>
        </div>
        <div class="acc-container">
            <div class="acc-details">
                <h2>Account Name: {{ $account->acc_name }}</h2>
                <h3>Account Balance: {{ $account->amount }}</h3>
            </div>
            <div class="acc-graph"></div>
        </div>
    </div>
@endsection
