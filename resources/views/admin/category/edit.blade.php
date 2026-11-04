@extends('admin.layout.app')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')
@section('subtitle', 'Edit Kategori Produk')

@section('content')
  <div class="card border-light shadow-sm">
    <div class="card-body">
      <!-- Header Card -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title mb-0">Form Edit Kategori</h5>
        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary btn-sm">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
      </div>

      <!-- Form Tambah User -->
      <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
        @csrf

        <!-- Input Nama -->
        <div class="mb-3">
          <label for="name" class="form-label">Nama Kategori</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Input Slug -->
        <div class="mb-3">
          <label for="slug" class="form-label">Slug (Opsional)</label>
          <input type="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
            value="{{ old('slug') }}" placeholder="contoh-slug">
          @error('slug')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Input Ikon -->
        <div class="mb-3">
          <label for="icon" class="form-label">Ikon</label>
          <input type="icon" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon"
            placeholder="Masukan ikon">
          @error('icon')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Input Sort Number -->
        <div class="mb-3">
          <label for="sort_order" class="form-label">Urutan Tampil</label>
          <input type="sort_order" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order"
            name="sort_order" placeholder="Masukan urutan">
          @error('sort_order')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-end gap-2 mt-4">
          <a href="{{ route('admin.category.index') }}" class="btn btn-light">Batal</a>
          <button type="submit" class="btn-custom btn-custom-primary" type="button">Simpan User</button>
        </div>
      </form>
    </div>
  </div>
@endsection