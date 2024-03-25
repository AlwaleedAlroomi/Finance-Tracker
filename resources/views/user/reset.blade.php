@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/login_page.css') }}">
@endsection

@section('content')
    @section('alert')
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endsection

    <div class="form-container">
        <form action="{{ route('password.reset') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
            </div>
            <div class="form-group">
                <label for="password02">Confirm Password</label>
                <input type="password" id="password02" name="password02" placeholder="Confirm your password">
            </div>
            <div class="form-group">
                <input id="subBtn" type="submit" value="Reset">
            </div>
        </form>
    </div>
    <script>
        function clickOnAlert() {
            const alerts = document.getElementsByClassName("alert");
            const alertContainer = document.getElementsByClassName("alert-container");
            alertContainer.addEventListener("click", function (event) {
                console.log(event.target);
            });
        }
    </script>
@endsection
