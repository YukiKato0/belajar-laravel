@extends('layout.app')

@php
    $configuration = $product->configuration ?? [];
    $materials = data_get($configuration, 'materials') ?: [[
        'name' => 'Bahan standar',
        'description' => 'Mengikuti spesifikasi produk',
        'price' => $product->price,
        'selected' => true,
    ]];
    $sides = data_get($configuration, 'sides') ?: [[
        'name' => '1 Sisi (Satu Muka)',
        'price' => 0,
        'selected' => false,
    ],
    [
        'name' => '2 Sisi (Bolak-balik)',
        'price' => 0,
        'selected' => true,
    ]];
    $finishes = data_get($configuration, 'finishes') ?: [[
        'name' => 'Finishing standar',
        'description' => 'Sudah termasuk harga produk',
        'price' => 0,
        'selected' => true,
    ]];
    $highlights = $product->detail_highlights ?? [];
    $fileRequirements = preg_split('/\r\n|\r|\n/', $product->file_requirements ?? '', -1, PREG_SPLIT_NO_EMPTY);
@endphp

@section('title', $product->name . ' | PrimaGraphia')

@section('content')
<div class="bg-light border-bottom py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a class="text-decoration-none text-muted" href="{{ url('/') }}"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none text-muted" href="{{ url('/#featured-products') }}">Produk</a></li>
                @if ($product->category)
                    <li class="breadcrumb-item"><span class="text-muted">{{ $product->category->name }}</span></li>
                @endif
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4 my-2">
    <div class="row g-4 g-xl-5">
        <div class="col-12 col-lg-6">
            <div class="card border rounded-4 shadow-sm overflow-hidden mb-3 bg-white">
                <div class="position-relative p-4 p-md-5 d-flex align-items-center justify-content-center" style="min-height: 420px; background: radial-gradient(circle at 50% 40%, #ffffff 0%, #edf3f8 100%);">
                    <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-1" style="z-index: 3;">
                        @if ($product->is_best_seller)<span class="badge bg-danger px-3 py-2 text-uppercase fw-bold rounded-pill shadow-sm" style="font-size: .7rem;">Terlaris</span>@endif
                        @if ($product->detail_badge)<span class="badge bg-primary px-3 py-2 text-uppercase fw-bold rounded-pill shadow-sm" style="font-size: .7rem;">{{ $product->detail_badge }}</span>@endif
                    </div>
                    <button class="btn btn-sm btn-white end-0 bg-white border shadow-sm rounded-circle p-2 text-secondary position-absolute top-0 m-3" style="z-index: 3;" type="button" aria-label="Simpan produk" title="Simpan ke wishlist">
                        <i class="bi bi-heart text-danger"></i>
                    </button>
                    @if ($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-3" style="max-height: 330px; object-fit: contain;">
                    @else
                        <div class="product-detail-preview position-relative shadow-lg rounded-3" id="mainCardVisual">
                            <div class="product-detail-shimmer position-absolute w-100 h-100 rounded-3"></div>
                            <div class="position-relative p-4 h-100 d-flex flex-column justify-content-between" style="z-index: 2;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-warning fs-5 mb-0" style="font-weight: 800; text-shadow: 0 0 10px rgba(255,215,0,.5);">PT PRIMA INOVASI</div>
                                        <div class="text-light opacity-75" style="font-size: .65rem; letter-spacing: 2px;">DIGITAL SOLUTIONS</div>
                                    </div>
                                    <span class="bg-warning text-dark px-2 py-0 rounded fw-bold" style="font-size: .65rem; border: 1px solid #ffd700;">PREMIUM</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <div class="text-white fw-bold" style="font-size: .9rem;">{{ $product->name }}</div>
                                        <div class="text-warning" style="font-size: .7rem; font-weight: 600;">{{ $product->detail_badge ?: ($product->category?->name ?? 'Produk Premium') }}</div>
                                        <div class="text-white-50 mt-1" style="font-size: .62rem;">PrimaGraphia • Cetak berkualitas</div>
                                    </div>
                                    <i class="bi bi-qr-code text-warning fs-3"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="position-absolute bottom-0 inset-s-50 translate-middle-x mb-2 text-muted small d-flex align-items-center gap-1 text-nowrap" style="font-size: .75rem;">
                        <i class="bi bi-zoom-in text-primary"></i> Preview interaktif produk
                    </div>
                </div>
            </div>

            <div class="row row-cols-4 g-2 mb-4">
                @foreach ([['depan', 'Tampak Depan', 'bi-card-heading', 'bg-dark text-warning'], ['belakang', 'Tampak Belakang', 'bi-credit-card-2-back', 'bg-secondary bg-opacity-25 text-dark'], ['detail', 'Detail Foil UV', 'bi-stars', 'bg-warning bg-opacity-25 text-dark'], ['kemasan', 'Box Kemasan', 'bi-box-seam', 'bg-light text-dark']] as [$type, $label, $icon, $tileStyle])
                    <div class="col">
                        <button class="btn product-thumbnail w-100 border {{ $loop->first ? 'border-2 border-primary shadow-xs' : 'opacity-75' }} rounded-3 bg-white p-1 text-center" type="button" data-preview="{{ $type }}">
                            <span class="{{ $tileStyle }} rounded-2 py-3 fw-bold small d-block text-truncate" style="font-size: .7rem;">
                                <i class="bi {{ $icon }} d-block fs-6 mb-1 {{ $loop->first ? 'text-white' : 'text-primary' }}"></i>{{ $label }}
                            </span>
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="card border rounded-4 shadow-sm overflow-hidden mb-4">
                <div class="card-header bg-white border-bottom px-3 px-md-4 pt-3">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item" role="presentation"><button class="nav-link active fw-semibold text-dark pb-3 border-top-0 border-start-0 border-end-0 border-bottom border-3 border-primary" data-bs-toggle="tab" data-bs-target="#product-description" type="button" role="tab"><i class="bi bi-info-circle me-1 text-primary"></i>Deskripsi</button></li>
                        <li class="nav-item" role="presentation"><button class="nav-link fw-semibold text-muted pb-3 border-0" data-bs-toggle="tab" data-bs-target="#product-specs" type="button" role="tab"><i class="bi bi-file-earmark-check me-1 text-success"></i>Spesifikasi File</button></li>
                        <li class="nav-item" role="presentation"><button class="nav-link fw-semibold text-muted pb-3 border-0" data-bs-toggle="tab" data-bs-target="#product-templates" type="button" role="tab"><i class="bi bi-download me-1 text-danger"></i>Unduh Template</button></li>
                    </ul>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-description" role="tabpanel">
                            <h2 class="h6 fw-bold text-dark mb-2">Eksklusivitas {{ $product->name }}</h2>
                            <p class="text-secondary small lh-base mb-3">{{ $product->description ?: 'Produk cetak premium PrimaGraphia dirancang untuk menghasilkan warna tajam, detail presisi, dan impresi profesional. Diproduksi menggunakan teknologi cetak digital modern dengan material pilihan.' }}</p>
                            @if ($highlights)
                                <div class="row g-2 mb-3">
                                    @foreach ($highlights as $highlight)
                                        <div class="col-sm-6">
                                            <div class="p-2 border rounded-3 bg-light h-100 d-flex align-items-start gap-2">
                                                <i class="{{ $highlight['icon'] ?? 'bi bi-check-circle-fill' }} text-primary fs-5 mt-1"></i>
                                                <div><span class="d-block fw-bold small text-dark">{{ $highlight['title'] ?? '' }}</span><span class="text-muted" style="font-size: .75rem;">{{ $highlight['description'] ?? '' }}</span></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if (!empty($configuration['note']))
                                <div class="alert alert-info py-2 px-3 small d-flex align-items-center gap-2 mb-0 rounded-3"><i class="bi bi-lightbulb-fill text-primary fs-5"></i><div>{{ $configuration['note'] }}</div></div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="product-specs" role="tabpanel">
                            <h2 class="h6 fw-bold text-dark mb-2">Panduan Penyiapan File Siap Cetak</h2>
                            @if ($fileRequirements)
                                <ul class="list-unstyled small text-secondary mb-0">
                                    @foreach ($fileRequirements as $requirement)
                                        <li class="mb-2 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i><span>{{ $requirement }}</span></li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="small text-muted mb-0">Hubungi tim kami untuk panduan file produk ini.</p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="product-templates" role="tabpanel">
                            <p class="small text-secondary">Unduh template desain produk sebelum menyiapkan file cetak.</p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ([['template_pdf_url', 'PDF', 'btn-outline-danger', 'bi-filetype-pdf'], ['template_ai_url', 'AI', 'btn-outline-warning', 'bi-filetype-ai'], ['template_psd_url', 'PSD', 'btn-outline-primary', 'bi-filetype-psd']] as [$field, $label, $style, $icon])
                                    @if ($product->{$field})
                                        <a class="btn {{ $style }} btn-sm d-inline-flex align-items-center gap-2" href="{{ $product->{$field} }}" target="_blank" rel="noopener noreferrer"><i class="bi {{ $icon }}"></i>Template {{ $label }}</a>
                                    @endif
                                @endforeach
                                @if (!$product->template_pdf_url && !$product->template_ai_url && !$product->template_psd_url)
                                    <span class="small text-muted">Template belum tersedia.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 text-center">
            <div class="col-4"><div class="p-2 border rounded-3 bg-white"><i class="bi bi-shield-check text-primary fs-4 d-block mb-1"></i><span class="fw-bold small d-block">Garansi Presisi</span><span class="text-muted" style="font-size:.7rem">Hasil berkualitas</span></div></div>
            <div class="col-4"><div class="p-2 border rounded-3 bg-white"><i class="bi bi-lightning-charge-fill text-warning fs-4 d-block mb-1"></i><span class="fw-bold small d-block">Cepat &amp; Tepat</span><span class="text-muted" style="font-size:.7rem">{{ $product->production_time ?: 'Sesuai antrean' }}</span></div></div>
            <div class="col-4"><div class="p-2 border rounded-3 bg-white"><i class="bi bi-truck text-success fs-4 d-block mb-1"></i><span class="fw-bold small d-block">Ambil di Outlet</span><span class="text-muted" style="font-size:.7rem">Atau kirim ke rumah</span></div></div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 small fw-semibold">{{ $product->detail_badge ?: 'Produk Unggulan' }}</span>
                    <span class="text-muted small">SKU: <span class="fw-semibold text-dark">{{ $product->sku ?: 'PG-' . str_pad((string) $product->id, 6, '0', STR_PAD_LEFT) }}</span></span>
                </div>
                <h1 class="h3 fw-extrabold text-dark mb-2">{{ $product->name }}</h1>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-warning small d-flex" aria-label="Rating {{ $product->rating }} dari 5">
                        @for ($star = 1; $star <= 5; $star++)<i class="bi {{ $product->rating >= $star ? 'bi-star-fill' : ($product->rating >= $star - 0.5 ? 'bi-star-half' : 'bi-star') }}"></i>@endfor
                    </span>
                    <span class="fw-bold text-dark small">{{ number_format((float) $product->rating, 1, ',', '.') }}</span>
                    <span class="text-muted small">•</span>
                    <a class="text-primary text-decoration-none small fw-medium" href="#reviews">{{ number_format($product->review_count) }} Ulasan Terverifikasi</a>
                    <span class="text-muted small">•</span>
                    <span class="text-success small fw-medium"><i class="bi bi-check-circle me-1"></i>{{ number_format($product->sold_count) }}+ {{ $product->price_unit }} terjual</span>
                </div>
            </div>

            <section class="card border rounded-4 shadow-sm bg-white p-3 p-md-4 mb-4" aria-labelledby="configuration-title">
                <h2 id="configuration-title" class="h5 fw-bold text-dark border-bottom pb-3 mb-3 d-flex align-items-center gap-2"><i class="bi bi-sliders2-vertical text-primary"></i>Konfigurasi Spesifikasi Cetak</h2>

                @if ($materials)
                    <fieldset class="mb-3 border-0 p-0">
                        <legend class="form-label fw-bold text-dark small mb-1">1. Jenis Bahan Kertas:</legend>
                        <div class="row g-2" id="materialOptions">
                            @foreach ($materials as $material)
                                <div class="col-12 col-md-4">
                                    <input class="btn-check" id="material-{{ $loop->index }}" name="productMaterial" type="radio" value="{{ $loop->index }}" data-price="{{ $material['price'] ?? $product->price }}" @checked($material['selected'] ?? $loop->first)>
                                    <label class="btn btn-outline-secondary w-100 text-start p-2 h-100 rounded-3 text-dark border-2 position-relative" for="material-{{ $loop->index }}">
                                        <span class="fw-bold small d-block">{{ $material['name'] ?? 'Bahan ' . $loop->iteration }}</span>
                                        <span class="text-muted d-block" style="font-size: .7rem;">{{ $material['description'] ?? '' }}</span>
                                        @if ($material['selected'] ?? $loop->first)<span class="badge bg-primary text-white position-absolute top-0 end-0 m-1" style="font-size: .6rem;">Default</span>@endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                @endif

                @if ($sides)
                    <fieldset class="mb-3 border-0 p-0">
                        <legend class="form-label fw-bold text-dark small mb-1">2. Sisi Cetak:</legend>
                        <div class="row g-2">
                            @foreach ($sides as $side)
                                <div class="col-6">
                                    <input class="btn-check" id="side-{{ $loop->index }}" name="productSides" type="radio" value="{{ $loop->index }}" data-price="{{ $side['price'] ?? 0 }}" @checked($side['selected'] ?? $loop->last)>
                                    <label class="btn btn-outline-secondary w-100 py-2 rounded-3 text-dark border-2" for="side-{{ $loop->index }}"><i class="bi {{ $loop->last ? 'bi-arrow-repeat' : 'bi-front' }} me-1 text-primary"></i>{{ $side['name'] ?? 'Opsi ' . $loop->iteration }} <span class="small text-muted">{{ !empty($side['price']) ? '(+Rp ' . number_format($side['price'], 0, ',', '.') . ')' : '' }}</span></label>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                @endif

                @if ($finishes)
                    <fieldset class="mb-3 border-0 p-0">
                        <legend class="form-label fw-bold text-dark small mb-1">3. Finishing Eksklusif:</legend>
                        <div class="row g-2">
                            @foreach ($finishes as $finish)
                                <div class="col-sm-6">
                                    <div class="form-check p-2 border rounded-3 bg-light">
                                        <input class="form-check-input ms-1 me-2 finish-option" id="finish-{{ $loop->index }}" type="checkbox" data-price="{{ $finish['price'] ?? 0 }}" @checked($finish['selected'] ?? false) @disabled($finish['disabled'] ?? false)>
                                        <label class="form-check-label small fw-semibold text-dark" for="finish-{{ $loop->index }}">{{ $finish['name'] ?? 'Finishing ' . $loop->iteration }} <span class="badge {{ empty($finish['price']) ? 'bg-success' : 'bg-secondary' }} ms-1 fw-normal" style="font-size: .65rem;">{{ !empty($finish['price']) ? '+Rp ' . number_format($finish['price'], 0, ',', '.') : 'Gratis' }}</span></label>
                                        <div class="text-muted ms-4" style="font-size: .7rem;">{{ $finish['description'] ?? '' }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                @endif

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1 gap-2">
                        <label class="form-label fw-bold text-dark small mb-0" for="customQtyInput">4. Jumlah Kuantitas:</label>
                        <span class="badge bg-success-subtle text-success border border-success-subtle small fw-semibold" id="tierDiscountBadge">Harga satuan</span>
                    </div>
                    <div class="btn-group w-100 mb-2" role="group" aria-label="Pilih jumlah cepat">
                        @foreach ([1, 2, 5, 10, 20] as $quantity)
                            <input class="btn-check quick-quantity" id="qty-{{ $quantity }}" name="quickQty" type="radio" value="{{ $quantity }}" data-qty="{{ max($quantity, $product->minimum_order) }}">
                            <label class="btn btn-outline-primary btn-sm py-2 fw-semibold" for="qty-{{ $quantity }}">{{ $quantity === 20 ? '20+' : $quantity }} {{ $product->price_unit }}@if ($quantity === 5 || $quantity === 10)<span class="badge bg-danger ms-1" style="font-size: .6rem;">-{{ $quantity === 5 ? '15' : '25' }}%</span>@endif</label>
                        @endforeach
                    </div>
                    <div class="input-group input-group-sm w-75">
                        <button class="btn btn-outline-secondary" type="button" id="decreaseQuantity" aria-label="Kurangi jumlah"><i class="bi bi-dash"></i></button>
                        <input class="form-control text-center fw-bold" id="customQtyInput" type="number" min="{{ $product->minimum_order }}" max="500" value="{{ max(2, $product->minimum_order) }}" inputmode="numeric">
                        <span class="input-group-text bg-light text-muted">{{ $product->price_unit }}</span>
                        <button class="btn btn-outline-secondary" type="button" id="increaseQuantity" aria-label="Tambah jumlah"><i class="bi bi-plus"></i></button>
                    </div>
                </div>

                @if (!empty($configuration['design_fee']))
                    <div class="border rounded-3 p-3 bg-light mb-3">
                        <div class="form-check">
                            <input class="form-check-input" id="needDesignService" type="checkbox" data-price="{{ $configuration['design_fee'] }}">
                            <label class="form-check-label small text-secondary" for="needDesignService"><span class="fw-semibold text-dark">Belum Punya Desain?</span> Gunakan Jasa Desain Grafis Prima (+Rp {{ number_format($configuration['design_fee'], 0, ',', '.') }})</label>
                        </div>
                        <div class="form-check mt-1">
                            <input class="form-check-input" id="sendLater" type="checkbox">
                            <label class="form-check-label small text-secondary" for="sendLater">Pesan Sekarang, Upload File Nanti (via Email/WhatsApp CS)</label>
                        </div>
                    </div>
                @endif

                <div class="border rounded-3 p-3 bg-light mb-3">
                    <label class="form-label fw-bold text-dark small mb-2 d-flex align-items-center gap-1" for="designFile"><i class="bi bi-cloud-arrow-up text-primary fs-5"></i>5. Unggah File Desain {{ $product->name }}</label>
                    <div class="border-2 border-dashed rounded-3 p-3 text-center bg-white mb-2" id="designDropzone" style="border-color: #cbd5e1 !important; cursor: pointer;">
                        <input class="d-none" id="designFile" type="file" accept=".pdf,.ai,.cdr,.zip,.png,.jpg,.jpeg">
                        <i class="bi bi-cloud-arrow-up-fill text-primary fs-2 d-block mb-1"></i>
                        <div class="fw-bold small text-dark" id="uploadLabel">Tarik &amp; lepas file desain di sini, atau <span class="text-primary text-decoration-underline">Klik Cari File</span></div>
                        <div class="text-muted" style="font-size: .725rem;">Format didukung: PDF, AI, CDR, ZIP, PNG, JPG</div>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <div class="form-check"><input class="form-check-input" id="sendDesignLater" type="checkbox"><label class="form-check-label small text-secondary" for="sendDesignLater"><span class="fw-semibold text-dark">Belum Punya Desain?</span> Gunakan Jasa Desain Grafis Prima (+Rp 25.000)</label></div>
                        <div class="form-check"><input class="form-check-input" id="sendDesignLater" type="checkbox"><label class="form-check-label small text-secondary" for="sendDesignLater">Pesan Sekarang, Upload File Nanti (via Email/WhatsApp CS)</label></div>
                    </div>
                </div>

                <div class="bg-primary-subtle border border-primary-subtle rounded-3 p-3 mb-3">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <div class="text-muted small">Total Estimasi Harga:</div>
                            <div class="d-flex align-items-baseline gap-2">
                                <span class="h3 fw-extrabold text-primary mb-0" id="totalPriceDisplay">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-muted text-decoration-line-through small" id="strikethroughPrice" style="font-size: .8rem;"></span>
                            </div>
                            <div class="text-success small fw-semibold mt-1" style="font-size: .75rem;"><i class="bi bi-clock-history me-1"></i>Estimasi Selesai: <strong>{{ $product->production_time ?: 'Dikonfirmasi saat pemesanan' }}</strong></div>
                        </div>
                        <div class="col-5 text-end"><div class="badge bg-primary text-white py-1 px-2 rounded-2" style="font-size: .75rem;"><span id="pricePerBox">Rp {{ number_format($product->price, 0, ',', '.') }}</span> / {{ $product->price_unit }}</div></div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2">
                    <a class="btn btn-primary btn-lg rounded-pill fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center gap-2" id="orderViaWhatsapp" href="https://wa.me/62811987990" target="_blank" rel="noopener noreferrer"><i class="bi bi-bag-check-fill fs-5"></i>Beli Sekarang / Checkout Langsung</a>
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-primary rounded-pill py-2 fw-semibold w-100 d-flex align-items-center justify-content-center gap-2" id="addToCartWhatsapp" href="https://wa.me/62811987990" target="_blank" rel="noopener noreferrer"><i class="bi bi-cart-plus fs-5"></i>Tambah ke Keranjang</a>
                        <a class="btn btn-outline-success rounded-pill py-2 px-3 fw-semibold d-flex align-items-center gap-1" href="https://wa.me/62811987990" target="_blank" rel="noopener noreferrer" title="Konsultasi via WhatsApp"><i class="bi bi-whatsapp fs-5"></i></a>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top text-center text-muted small" style="font-size: .75rem;"><i class="bi bi-shield-lock-fill text-success me-1"></i>Transaksi 100% Aman • Hasil Terjamin PrimaGraphia • Layanan Cepat</div>
            </section>
        </div>
    </div>

    @if ($relatedProducts->isNotEmpty())
        <section class="border-top mt-5 pt-4" aria-labelledby="related-products-title">
            <h2 id="related-products-title" class="h4 fw-bold mb-3">Produk terkait</h2>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col">
                        <a class="product-card d-block h-100 text-decoration-none" href="{{ route('products.show', $relatedProduct) }}">
                            <div class="product-img-container d-flex align-items-center justify-content-center text-primary fs-1"><i class="{{ $relatedProduct->icon_class }}"></i></div>
                            <div class="p-3"><span class="small text-muted">{{ $relatedProduct->category?->name }}</span><h3 class="h6 fw-bold text-dark mt-1">{{ $relatedProduct->name }}</h3><span class="fw-bold text-primary">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }} / {{ $relatedProduct->price_unit }}</span></div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>

<style>
    .product-detail-preview{width:340px;height:198px;max-width:100%;background:linear-gradient(135deg,#0e1e38 0%,#1e3a63 60%,#0d223f 100%);transform:rotate(-3deg);transition:all .4s cubic-bezier(.165,.84,.44,1);border:1px solid rgba(255,255,255,.15);overflow:hidden}
    .product-detail-shimmer{inset:0;background:linear-gradient(115deg,transparent 20%,rgba(212,175,55,.4) 45%,rgba(255,255,255,.6) 50%,rgba(212,175,55,.3) 55%,transparent 80%);mix-blend-mode:color-dodge;opacity:.85;pointer-events:none}
    .product-thumbnail.active{border-color:var(--bs-primary)!important;box-shadow:0 0 0 1px var(--bs-primary)}
    @media(max-width:575.98px){.product-detail-preview{width:min(340px,calc(100vw - 5rem));height:auto;aspect-ratio:340/198}.btn-group .btn{padding-inline:.25rem;font-size:.72rem}}
</style>

<script>
    window.productDetailConfig = {{ Illuminate\Support\Js::from([
        'name' => $product->name,
        'price' => $product->price,
        'priceUnit' => $product->price_unit,
        'minimumOrder' => $product->minimum_order,
        'discounts' => data_get($configuration, 'discounts', []),
    ]) }};
</script>
<script src="{{ asset('primagraphia-web/assets/js/detail-produk.js') }}"></script>
@endsection
