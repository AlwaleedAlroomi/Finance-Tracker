@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/show_income.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="btn">
            <a class="edit" href="{{ route('incomes.edit', $income) }}">Edit Income</a>
            <a class="delete" href="{{ route('incomes.delete', $income) }}"
                onclick="return confirm('Do you want to delete this income?');">Delete Income</a>
        </div>
        <div class="acc-container">
            <div class="acc-details">
                <h2>Income Source: {{ $income->name }}</h2>
                <h3>Income Amount: {{ $income->amount }}</h3>
                <h3>Income Account: {{ $income->account->acc_name }}</h3>
            </div>
        </div>
    </div>
@endsection
