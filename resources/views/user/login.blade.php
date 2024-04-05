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
    <form action="{{ route('user.login') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="password" type="password" id="password" name="password" placeholder="Enter your password">
            <span class="show-pass" id="show-pass" onclick="togglePasswordVisibility()">
                <i class="fa fa-eye"></i>
            </span>
        </div>
        <div class="btn">
            <a href="{{ route('user.register') }}">New Here?Sign Up</a>
            <a href="{{ route('user.forget') }}">Forget Password?</a>
        </div>
        <div class="form-group">
            <input id="subBtn" type="submit" value="Sign In">
        </div>
    </form>
</div>
<script>
    function clickOnAlert() {
        const alerts = document.getElementsByClassName("alert");
        const alertContainer = document.getElementsByClassName("alert-container");
        alertContainer.addEventListener("click", function(event) {
            console.log(event.target);
        });
    }

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const showPasword = document.getElementById('show-pass');
        showPasword.addEventListener('mousedown', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasword.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                showPasword.innerHTML = '<i class="fa fa-eye"></i>';
            }
        })
    }
</script>
@endsection
