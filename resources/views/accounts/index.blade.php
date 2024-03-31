@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="css/acc_index.css">
@endsection
@section('content')
    <div class="link-container">
        <div class="link">
            <a href="{{ route('accounts.create') }}">Create Account</a>
        </div>
    </div>
    <div id="card" class="card-container">
        @foreach ($accounts as $account)
            <div class="card" data-account-id="{{ $account->id }}">
                <H2>{{ $account->acc_name }}</H2>
                <p>{{ $account->amount }}</p>
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
                var editUrl = "/accounts/" + accountId + "/show";
                // Redirect to the edit route for the clicked account
                window.location.href = editUrl;
            });
        });
    </script>
@endsection
