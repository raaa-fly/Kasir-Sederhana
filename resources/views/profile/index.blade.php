@extends('layout')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container">
    <h4 class="mb-4">Profil Pengguna</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
                <tr>
                    <th>Dibuat pada</th>
                    <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
