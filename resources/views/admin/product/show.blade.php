<div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Maria Skłodowska-Curie -->
@extends('admin.layout.app')

@section('title', 'Detail Produk')
@section('page-title', 'Detail Produk')
@section('subtitle', 'Informasi katalog produk')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h2 class="h5 mb-0">{{ $product->name }}</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.product.index') }}" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
                <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-custom-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                @if ($product->is_active)
                    <a href="{{ route('products.show', ['product' => $product->slug]) }}" class="btn btn-custom-primary btn-sm" target="_blank" rel="noopener noreferrer"><i class="bi bi-box-arrow-up-right"></i> Pratinjau</a>
                @endif
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="border rounded-3 bg-light d-flex align-items-center justify-content-center p-4" style="min-height: 220px;">
                    @if ($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 190px; object-fit: contain;">
                    @else
                        <i class="{{ $product->icon_class }} text-primary" style="font-size: 5rem;"></i>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <tbody>
                            <tr><th style="width: 30%;">SKU</th><td>{{ $product->sku ?? '-' }}</td></tr>
                            <tr><th>Kategori</th><td>{{ $product->category?->name ?? '-' }}</td></tr>
                            <tr><th>Harga</th><td>Rp {{ number_format($product->price, 0, ',', '.') }} / {{ $product->price_unit }}</td></tr>
                            <tr><th>Rating</th><td>{{ number_format((float) $product->rating, 1, ',', '.') }} ({{ number_format($product->review_count) }} ulasan)</td></tr>
                            <tr><th>Terjual</th><td>{{ number_format($product->sold_count) }}</td></tr>
                            <tr><th>Estimasi produksi</th><td>{{ $product->production_time ?? '-' }}</td></tr>
                            <tr><th>Minimum order</th><td>{{ $product->minimum_order }} {{ $product->price_unit }}</td></tr>
                            <tr><th>Status</th><td>
                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                @if ($product->is_new)<span class="badge bg-danger">Baru</span>@endif
                                @if ($product->is_best_seller)<span class="badge bg-warning text-dark">Terlaris</span>@endif
                            </td></tr>
                        </tbody>
                    </table>
                </div>
                <h3 class="h6 fw-bold mt-3">Deskripsi</h3>
                <p class="text-muted mb-0">{{ $product->description ?: 'Belum ada deskripsi.' }}</p>
            </div>
            @if ($product->detail_highlights)
                <div class="col-md-6">
                    <h3 class="h6 fw-bold">Highlight</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($product->detail_highlights as $highlight)
                            <li class="list-group-item px-0"><i class="{{ $highlight['icon'] ?? 'bi bi-check-circle' }} text-primary me-2"></i><strong>{{ $highlight['title'] ?? '' }}</strong><span class="text-muted">: {{ $highlight['description'] ?? '' }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($product->file_requirements)
                <div class="col-md-6">
                    <h3 class="h6 fw-bold">Panduan File Desain</h3>
                    <p class="text-muted mb-0">{!! nl2br(e($product->file_requirements)) !!}</p>
                </div>
            @endif
            @if ($product->configuration)
                <div class="col-12">
                    <h3 class="h6 fw-bold">Konfigurasi Pesanan</h3>
                    <pre class="bg-light border rounded-3 p-3 small mb-0"><code>{{ json_encode($product->configuration, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</code></pre>
                </div>
            @endif
            <div class="col-12">
                <h3 class="h6 fw-bold">File Template</h3>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ([['PDF', $product->template_pdf_url], ['AI', $product->template_ai_url], ['PSD', $product->template_psd_url]] as [$type, $url])
                        @if ($url)<a href="{{ $url }}" class="btn btn-outline-primary btn-sm" target="_blank" rel="noopener noreferrer">Template {{ $type }}</a>@endif
                    @endforeach
                    @if (!$product->template_pdf_url && !$product->template_ai_url && !$product->template_psd_url)<span class="text-muted small">Belum ada template.</span>@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
