@extends('layout.app')

@section('title', 'Semua Produk | PrimaGraphia')

@section('content')
<div class="container py-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2 small">
            <li class="breadcrumb-item"><a class="text-decoration-none text-muted" href="{{ url('/') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
            <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Semua Produk</li>
        </ol>
    </nav>

    <section class="card border-0 rounded-4 shadow-sm mb-4 overflow-hidden position-relative" style="background: linear-gradient(135deg, #002e5b 0%, #004b93 60%, #e30613 100%);">
        <div class="position-absolute top-0 bottom-0 opacity-10 d-none d-md-block pe-5" aria-hidden="true" style="right: 0;">
            <i class="bi bi-printer-fill" style="font-size: 11rem; line-height: 1; color: #ffffff;"></i>
        </div>
        <div class="card-body p-4 p-lg-5 text-white position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-danger rounded-pill px-3 py-1 mb-2 fw-semibold">KATALOG RESMI PRIMAGRAPHIA</span>
                    <h1 class="display-6 fw-bold mb-2">Semua Produk Percetakan</h1>
                    <p class="lead fs-6 text-white-50 mb-3" style="max-width: 650px;">Pilihan lengkap solusi cetak digital, packaging, promosi usaha, hingga cinderamata dengan standar mutu terbaik dan harga langsung produsen.</p>
                    <div class="d-flex flex-wrap gap-2 text-white small">
                        <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1"><i class="bi bi-lightning-charge-fill text-warning me-1"></i>Bisa Kirim Se-Indonesia</span>
                        <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1"><i class="bi bi-check-circle-fill text-success me-1"></i>Garansi Cetak Tajam</span>
                        <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1"><i class="bi bi-shield-check text-info me-1"></i>Pembayaran Aman</span>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0 d-none d-lg-block">
                    <div class="bg-white bg-opacity-10 rounded-3 p-3 d-inline-block text-start border border-white border-opacity-25 shadow-sm">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-headset fs-3 text-warning"></i>
                            <div>
                                <div class="small fw-semibold text-white">Butuh Ukuran Kustom?</div>
                                <div class="text-white-50" style="font-size: 0.75rem;">Konsultasikan via WhatsApp</div>
                            </div>
                        </div>
                        <a class="btn btn-sm btn-light text-primary fw-bold w-100 rounded-pill mt-2" href="https://wa.me/62811987990">Chat CS Cetak</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row g-4">
        <aside class="col-lg-3">
            <form action="{{ route('catalog.index') }}" method="GET" class="card border rounded-4 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h2 class="h6 mb-0 fw-bold d-flex align-items-center text-dark"><i class="bi bi-funnel-fill text-primary me-2"></i>Filter Produk</h2>
                    <a class="small fw-semibold text-decoration-none text-danger" href="{{ route('catalog.index') }}">Reset</a>
                </div>
                <div class="card-body p-3">
                    <input type="hidden" name="q" value="{{ $filters['q'] ?? '' }}">
                    <input type="hidden" name="sort" value="{{ $filters['sort'] ?? 'relevance' }}">
                    <fieldset class="mb-3">
                        <legend class="h6 small fw-semibold text-dark">Kategori Produk</legend>
                        @forelse ($categories as $category)
                            <div class="form-check mb-2">
                                <input class="form-check-input" id="category-{{ $category->id }}" name="categories[]" type="checkbox" value="{{ $category->id }}" @checked(in_array($category->id, $selectedCategoryIds, true))>
                                <label class="form-check-label small text-secondary d-flex justify-content-between gap-2" for="category-{{ $category->id }}">
                                    <span>{{ $category->name }}</span><span class="badge text-bg-light rounded-pill">{{ $category->products_count }}</span>
                                </label>
                            </div>
                        @empty
                            <p class="small text-muted mb-0">Belum ada kategori produk.</p>
                        @endforelse
                    </fieldset>
                    <fieldset class="border-top pt-3">
                        <legend class="h6 small fw-semibold text-dark">Rentang Harga</legend>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label text-muted" for="minPrice" style="font-size: 0.72rem;">Min (Rp)</label>
                                <input class="form-control form-control-sm" id="minPrice" min="0" name="min_price" type="number" value="{{ $filters['min_price'] ?? '' }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label text-muted" for="maxPrice" style="font-size: 0.72rem;">Maks (Rp)</label>
                                <input class="form-control form-control-sm" id="maxPrice" min="0" name="max_price" type="number" value="{{ $filters['max_price'] ?? '' }}">
                            </div>
                        </div>
                    </fieldset>
                    <button class="btn btn-primary w-100 rounded-pill fw-semibold py-2 mt-3 d-flex align-items-center justify-content-center gap-2 shadow-sm" type="submit">
                        <i class="bi bi-check2-circle"></i>Terapkan Filter
                    </button>
                </div>
            </form>
        </aside>

        <section class="col-lg-9" aria-label="Daftar produk">
            <form action="{{ route('catalog.index') }}" class="card border rounded-4 shadow-sm mb-4" method="GET">
                @foreach ($selectedCategoryIds as $categoryId)
                    <input type="hidden" name="categories[]" value="{{ $categoryId }}">
                @endforeach
                <input type="hidden" name="q" value="{{ $filters['q'] ?? '' }}">
                <input type="hidden" name="min_price" value="{{ $filters['min_price'] ?? '' }}">
                <input type="hidden" name="max_price" value="{{ $filters['max_price'] ?? '' }}">
                <div class="card-body p-3 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                    <div class="text-secondary small">
                        Menampilkan <span class="fw-bold text-dark">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span>
                        dari <span class="fw-bold text-dark">{{ $products->total() }}</span> produk percetakan
                    </div>
                    <div class="d-flex align-items-center gap-2 w-100 w-sm-auto justify-content-end">
                        <label class="small text-muted text-nowrap d-none d-md-inline" for="sortSelect">Urutkan:</label>
                        <select class="form-select form-select-sm rounded-pill fw-medium" id="sortSelect" name="sort" style="min-width: 160px;" onchange="this.form.submit()">
                            <option value="relevance" @selected(($filters['sort'] ?? 'relevance') === 'relevance')>Paling Sesuai</option>
                            <option value="newest" @selected(($filters['sort'] ?? '') === 'newest')>Terbaru</option>
                            <option value="price_asc" @selected(($filters['sort'] ?? '') === 'price_asc')>Harga Terendah</option>
                            <option value="price_desc" @selected(($filters['sort'] ?? '') === 'price_desc')>Harga Tertinggi</option>
                            <option value="bestselling" @selected(($filters['sort'] ?? '') === 'bestselling')>Terlaris</option>
                        </select>
                        <div aria-label="Tampilan produk" class="btn-group btn-group-sm rounded-pill border p-1" role="group">
                            <button aria-label="Tampilan grid" class="btn btn-primary rounded-pill px-2 py-1" data-catalog-view="grid" type="button" title="Tampilan grid"><i class="bi bi-grid-3x3-gap-fill"></i></button>
                            <button aria-label="Tampilan daftar" class="btn btn-light rounded-pill px-2 py-1 text-secondary" data-catalog-view="list" type="button" title="Tampilan daftar"><i class="bi bi-view-list"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            @if ($products->isNotEmpty())
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="catalogContainer">
                    @foreach ($products as $product)
                        <div class="col">
                            <article class="card h-100 border rounded-4 overflow-hidden shadow-sm product-card position-relative">
                                @if ($product->is_new)
                                    <span class="badge bg-primary position-absolute top-0 m-3 z-2 px-2 py-1 rounded-pill small" style="left: 0;">Baru</span>
                                @elseif ($product->is_best_seller)
                                    <span class="badge bg-danger position-absolute top-0 m-3 z-2 px-2 py-1 rounded-pill small" style="left: 0;">Terlaris</span>
                                @elseif ($product->detail_badge)
                                    <span class="badge bg-warning text-dark position-absolute top-0 m-3 z-2 px-2 py-1 rounded-pill small" style="left: 0;">{{ $product->detail_badge }}</span>
                                @endif
                                <a class="text-decoration-none" href="{{ route('products.show', ['product' => $product->slug]) }}" aria-label="Lihat {{ $product->name }}">
                                    <div class="bg-light p-4 text-center position-relative d-flex align-items-center justify-content-center" style="height: 180px;">
                                        @if ($product->image_url)
                                            <img alt="{{ $product->name }}" class="img-fluid" src="{{ $product->image_url }}" style="max-height: 145px; object-fit: contain;">
                                        @else
                                            <i class="{{ $product->icon_class ?: 'bi bi-box-seam' }} text-primary opacity-50" style="font-size: 4.5rem;"></i>
                                        @endif
                                    </div>
                                </a>
                                <div class="card-body p-3 d-flex flex-column">
                                    <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">{{ $product->category?->name ?? 'Produk' }}</div>
                                    <h2 class="card-title h6 fw-bold text-dark mt-1 mb-2 text-truncate" title="{{ $product->name }}">{{ $product->name }}</h2>
                                    <div class="d-flex align-items-center gap-1 mb-2 small text-warning" aria-label="Rating {{ number_format((float) $product->rating, 1, ',', '.') }} dari 5">
                                        @for ($star = 1; $star <= 5; $star++)
                                            <i class="bi {{ $product->rating >= $star ? 'bi-star-fill' : ($product->rating >= $star - 0.5 ? 'bi-star-half' : 'bi-star') }}"></i>
                                        @endfor
                                        <span class="text-muted ms-1" style="font-size: 0.75rem;">({{ number_format($product->review_count) }})</span>
                                    </div>
                                    <div class="mt-auto">
                                        <div class="text-secondary small" style="font-size: 0.75rem;">Mulai dari</div>
                                        <div class="h6 fw-bold text-danger mb-3">Rp {{ number_format($product->price, 0, ',', '.') }} <span class="fw-normal text-muted small">/ {{ $product->price_unit }}</span></div>
                                        <a class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-semibold" href="{{ route('products.show', ['product' => $product->slug]) }}">Lihat Opsi / Order</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                <nav aria-label="Navigasi Halaman Katalog" class="mt-4 mb-3">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
                </nav>
            @else
                <div class="border rounded-4 bg-light py-5 px-3 text-center">
                    <i class="bi bi-search text-primary fs-1"></i>
                    <h2 class="h5 fw-bold mt-3">Produk tidak ditemukan</h2>
                    <p class="text-muted small mb-3">Coba ubah kata pencarian atau filter yang dipilih.</p>
                    <a class="btn btn-outline-primary btn-sm rounded-pill px-3" href="{{ route('catalog.index') }}">Lihat semua produk</a>
                </div>
            @endif

            <div class="card border rounded-4 bg-light p-3 mt-4 text-center">
                <div class="row align-items-center g-3">
                    <div class="col-md-4 d-flex align-items-center justify-content-center gap-2"><i class="bi bi-file-earmark-check-fill text-primary fs-4"></i><div class="text-start"><div class="fw-bold small">Cek File Gratis</div><div class="text-muted" style="font-size: 0.72rem;">File Anda dicek sebelum cetak</div></div></div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center gap-2"><i class="bi bi-truck text-danger fs-4"></i><div class="text-start"><div class="fw-bold small">Pickup &amp; Delivery</div><div class="text-muted" style="font-size: 0.72rem;">Ambil cabang / kirim instan</div></div></div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center gap-2"><i class="bi bi-patch-check-fill text-success fs-4"></i><div class="text-start"><div class="fw-bold small">Tersedia Harga Grosir</div><div class="text-muted" style="font-size: 0.72rem;">Makin banyak pesan, makin murah</div></div></div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    document.querySelectorAll('[data-catalog-view]').forEach((button) => {
        button.addEventListener('click', () => {
            const container = document.getElementById('catalogContainer');
            if (!container) return;

            const isList = button.dataset.catalogView === 'list';
            container.classList.toggle('row-cols-sm-2', !isList);
            container.classList.toggle('row-cols-md-3', !isList);
            container.classList.toggle('row-cols-1', isList);
            document.querySelectorAll('[data-catalog-view]').forEach((viewButton) => {
                const active = viewButton === button;
                viewButton.classList.toggle('btn-primary', active);
                viewButton.classList.toggle('btn-light', !active);
                viewButton.classList.toggle('text-secondary', !active);
            });
        });
    });
</script>
@endsection