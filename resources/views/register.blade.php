@extends('layout') {{-- Ganti sesuai nama layout utama kamu --}}

@section('title', 'Registrasi Pengguna')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
<li class="breadcrumb-item active">Registrasi</li>
@endsection

@section('content')
<h2 class="text-2xl font-bold text-center mb-6">Registrasi Pengguna</h2>

@if (session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mb-4">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium">Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium">Role</label>
        <select name="role" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            <option value="">-- Pilih Role --</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
        </select>
    </div>

    <div>
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
            Daftar
        </button>
    </div>

    <div class="text-center text-sm text-gray-500">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
    </div>
</form>

@if (session('success') || session('error'))
<script>
    // Menampilkan alert otomatis
    document.addEventListener('DOMContentLoaded', function() {
        alert("{{ session('success') ?: session('error') }}");
    });
</script>
@endif
@endsection