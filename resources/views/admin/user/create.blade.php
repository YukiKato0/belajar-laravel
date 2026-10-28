@extends('admin.layout.app')

@section('title', 'Create User')
@section('page-title', 'Create User')
@section('subtitle', 'Kelola akun yang memiliki akses ke dalam Admin Panel')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <!-- Header Card -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Form Tambah Pengguna Baru</h5>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Form Tambah User -->
        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <!-- Input Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 6/8 karakter" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.user.index') }}" class="btn btn-light">Batal</a>
                <button type="submit" class="btn-custom btn-custom-primary" type="button">Simpan User</button>
            </div>
        </form>
    </div>
</div>
@endsection