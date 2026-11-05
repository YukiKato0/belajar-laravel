@extends('admin.layout.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')
@section('subtitle', 'Tambah Kategori Produk Baru')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <!-- Header Card -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Form Tambah Kategori Baru</h5>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf

            <!-- Input Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Digital Printing" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug (Opsional)</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Otomatis dari nama kategori">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Kelas Ikon Bootstrap</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') }}" placeholder="bi bi-printer">
                @error('icon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="sort_order" class="form-label">Urutan Tampil</label>
                <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                @error('sort_order')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.category.index') }}" class="btn btn-light">Batal</a>
                <button type="submit" class="btn btn-custom-primary">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection