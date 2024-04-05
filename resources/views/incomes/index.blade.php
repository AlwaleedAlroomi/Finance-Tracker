@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/income_index.css') }}">
@endsection
@section('content')
    <div class="link-container">
        <div class="link">
            <a href="{{ route('incomes.create') }}">Add Income</a>
        </div>
    </div>
    <div id="card" class="card-container">
        @foreach ($incomes as $income)
            <div class="card" data-account-id="{{ $income->id }}">
                <H2>{{ $income->name }}</H2>
                <p>{{ $income->amount }}</p>
                <p>{{ $income->account->acc_name }}</p>
            </div>
        @endforeach
    </div>
    <script>
        var cards = document.querySelectorAll('.card');

        cards.forEach(function(card) {
            card.addEventListener('click', function() {
                // Get the account ID from the data-account-id attribute
                var accountId = card.getAttribute('data-account-id');
                // Redirect to the edit route for the clicked account
                var editUrl = "/incomes/" + accountId + "/show";
                // Redirect to the edit route for the clicked account
                window.location.href = editUrl;
            });
        });
    </script>
@endsection
