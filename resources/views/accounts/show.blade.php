@extends('layout.base')
@section('content')
    {{ $account->acc_name }}
    {{ $account->amount }}
@endsection
