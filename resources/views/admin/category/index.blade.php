@extends('admin.layout.app')

@section('title', 'Management Kategori')
@section('page-title', 'Management Kategori')
@section('subtitle', 'Pengelompokan kategori produk')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <!-- Header Card dengan Tombol Tambah User -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Daftar Pengguna</h5>
            <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-custom-primary">
                <i class="bi bi-person-add"></i>
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
                        <th>Urutan</th>
                        <th style="width: 15%;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->name ?? '-' }}</td>
                        <td>{{ $data->slug ?? '-' }}</td>
                        <td>{{ $data->sort_order ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.category.edit', $data->id) }}" class="btn btn-sm btn-custom-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.category.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-custom-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection