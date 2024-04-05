@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/income_create.css') }}">
@endsection
@section('content')
    <div class="form-container">
        <form action="{{ route('incomes.update', $income) }}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Source</label>
                <input type="text" name="name" id="name" value="{{ $income->name }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" value="{{ $income->description }}">
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
                <input type="number" name="amount" id="amount" value="{{ $income->amount }}">
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" onfocus="this.showPicker()" value="{{ $income->date }}">
            </div>
            <div class="form-group">
                <input id="subBtn" type="submit" value="Update Income">
            </div>
        </form>
    </div>
@endsection
