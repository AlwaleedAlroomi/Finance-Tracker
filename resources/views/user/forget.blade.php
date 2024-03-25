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
        <form action="{{ route('user.forget') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <input id="subBtn" type="submit" value="Send">
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
