@extends('admin.layout.app')

@section('title', 'Produk')
@section('page-title', 'Manajemen Produk')
@section('subtitle', 'Kelola katalog dan informasi harga produk')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Daftar Produk</h2>
            <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-custom-primary" aria-label="Tambah produk" title="Tambah produk">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Produk</th>
                        <th>SKU</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{ $products->firstItem() + $loop->index }}</td>
                        <td>
                            <i class="{{ $product->icon_class }} me-2 text-primary"></i>{{ $product->name }}
                            <div class="small text-muted">{{ $product->review_count }} ulasan · Rating {{ number_format((float) $product->rating, 1, ',', '.') }}</div>
                        </td>
                        <td>{{ $product->sku ?? '-' }}</td>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }} / {{ $product->price_unit }}</td>
                        <td>
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                            @if ($product->is_new)<span class="badge bg-danger">Baru</span>@endif
                            @if ($product->is_best_seller)<span class="badge bg-warning text-dark">Terlaris</span>@endif
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('admin.product.show', $product) }}" class="btn btn-sm btn-outline-secondary" aria-label="Lihat data {{ $product->name }}" title="Detail admin">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-sm btn-custom-warning" aria-label="Edit {{ $product->name }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @if ($product->is_active)
                            <a href="{{ route('products.show', ['product' => $product->slug]) }}" class="btn btn-sm btn-outline-primary" aria-label="Pratinjau {{ $product->name }}" title="Pratinjau publik">
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                            @endif
                            <form action="{{ route('admin.product.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-custom-danger" aria-label="Hapus {{ $product->name }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $products->links() }}
    </div>
</div>
@endsection
