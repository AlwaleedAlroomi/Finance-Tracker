@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/register_page.css') }}">
@endsection

@section('content')
@section('alert')
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endsection

<div class="form-container">
    <form action="{{ route('user.register') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <span class="show-pass" id="show-pass" onclick="togglePasswordVisibility()">
                <i class="fa fa-eye"></i>
            </span>
        </div>
        <div class="btn">
            <a href="{{ route('user.login') }}">Already a user?Sign In</a>
        </div>
        <div class="form-group">
            <input id="subBtn" type="submit" value="Sign Up">
        </div>
    </form>
</div>
<script>
    const button = document.getElementById("user-menu-button");
    const menu = document.getElementById("user-menu");

    button.addEventListener('click', function() {
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        if (!menu.contains(event.target) && !button.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });

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
