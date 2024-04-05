@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/income_create.css') }}">
@endsection
@section('content')
    <div class="form-container">
        <form action="{{ route('incomes.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Source</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description">
            </div>
            <div class="form-group">
                <label for="account_id">Account</label>
                {{-- <input type="" name="account_id" id="account_id"> --}}
                <select name="account_id" id="account_id" class="select">
                    @foreach ($userAccount as $account)
                        <option value="{{ $account->id }}">{{ $account->acc_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount">
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" onfocus="this.showPicker()">
            </div>
            <div class="form-group">
                <input id="subBtn" type="submit" value="Add Income">
            </div>
        </form>
    </div>
@endsection
