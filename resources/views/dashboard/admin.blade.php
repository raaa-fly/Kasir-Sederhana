@extends('layout')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Selamat datang, {{ Auth::user()->name }}!</h4>
            <p>Anda berhasil login sebagai <strong>{{ Auth::user()->role }}</strong>.</p>
        </div>
    </div>
@endsection
