@extends('admin.layout.app')

@section('title', 'Management Kategori')
@section('page-title', 'Management Kategori')
@section('subtitle', 'Pengelompokan kategori produk')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Daftar Kategori</h2>
            <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-custom-primary" aria-label="Tambah kategori" title="Tambah kategori">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>

        <!-- Tabel Responsif -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Nama</th>
                        <th>Slug</th>
                        <th>Ikon</th>
                        <th>Urutan</th>
                        <th style="width: 15%;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td><i class="{{ $category->icon }} me-2"></i>{{ $category->icon ?: '-' }}</td>
                        <td>{{ $category->sort_order }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-sm btn-custom-warning" aria-label="Edit {{ $category->name }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.category.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-custom-danger" aria-label="Hapus {{ $category->name }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection