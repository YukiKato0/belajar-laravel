@extends('admin.layout.app')

@section('page-title', 'Pengaturan Website')
@section('subtitle', 'Konfigurasi identitas website, logo, kontak dan informasi profil')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <ul class="nav nav-tabs mb-3" id="defaultTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                    <i class="bi bi-house-door me-1"></i> Pengaturan Umum
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kontak-lokasi-tab" data-bs-toggle="tab" data-bs-target="#kontak-lokasi-tab-pane"
                    type="button" role="tab" aria-controls="kontak-lokasi-tab-pane" aria-selected="false" tabindex="-1">
                    <i class="bi bi-geo-alt me-1"></i> Kontak & Lokasi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sosial-media-tab" data-bs-toggle="tab" data-bs-target="#sosial-media-tab-pane"
                    type="button" role="tab" aria-controls="sosial-media-tab-pane" aria-selected="false" tabindex="-1">
                    <i class="bi bi-share me-1"></i> Sosial Media
                </button>
            </li>
        </ul>

        <div class="tab-content text-muted-green small mb-4" id="defaultTabsContent">
            <!-- Tab Pengaturan Umum -->
            <div class="tab-pane fade active show mt-4" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <h5 class="mb-3 text-dark">Pengaturan Umum</h5>

                <div class="mb-3">
                    <label class="form-label text-dark">Site Name</label>
                    <input type="text" class="form-control" name="site_name"
                        value="{{ old('site_name', $setting['site_name'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Site Tagline</label>
                    <input type="text" class="form-control" name="site_tagline"
                        value="{{ old('site_tagline', $setting['site_tagline'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Site Description</label>
                    <textarea class="form-control" name="site_description" rows="3">{{ old('site_description', $setting['site_description'] ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Site Logo</label>
                    @if (!empty($setting['site_logo']))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $setting['site_logo']) }}" alt="Logo" class="img-thumbnail" style="max-height: 80px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="site_logo" accept="image/*">
                    <small class="text-muted">Format: PNG, JPG, JPEG, WEBP. Maksimal 2MB.</small>
                </div>
            </div>
            
            <!-- Tab Kontak & Lokasi -->
            <div class="tab-pane fade mt-4" id="kontak-lokasi-tab-pane" role="tabpanel" aria-labelledby="kontak-lokasi-tab" tabindex="0">
                <h5 class="mb-3 text-dark">Kontak & Lokasi</h5>

                <div class="mb-3">
                    <label class="form-label text-dark">Nomor Telepon Utama</label>
                    <input type="text" class="form-control" name="phone"
                        value="{{ old('phone', $setting['phone'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Email Upload</label>
                    <input type="email" class="form-control" name="email_upload"
                        value="{{ old('email_upload', $setting['email_upload'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Email Order</label>
                    <input type="email" class="form-control" name="email_order"
                        value="{{ old('email_order', $setting['email_order'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Alamat</label>
                    <textarea name="address" rows="3" class="form-control">{{ old('address', $setting['address'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- Tab Sosial Media -->
            <div class="tab-pane fade mt-4" id="sosial-media-tab-pane" role="tabpanel" aria-labelledby="sosial-media-tab" tabindex="0">
                <h5 class="mb-3 text-dark">Sosial Media</h5>

                <div class="mb-3">
                    <label class="form-label text-dark">Url Shopee</label>
                    <input type="url" class="form-control" name="url_shopee"
                        value="{{ old('url_shopee', $setting['url_shopee'] ?? '') }}" placeholder="https://shopee.co.id/...">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Url Facebook</label>
                    <input type="url" class="form-control" name="url_facebook"
                        value="{{ old('url_facebook', $setting['url_facebook'] ?? '') }}" placeholder="https://facebook.com/...">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Url Instagram</label>
                    <input type="url" class="form-control" name="url_instagram"
                        value="{{ old('url_instagram', $setting['url_instagram'] ?? '') }}" placeholder="https://instagram.com/...">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Url YouTube</label>
                    <input type="url" class="form-control" name="url_youtube"
                        value="{{ old('url_youtube', $setting['url_youtube'] ?? '') }}" placeholder="https://youtube.com/...">
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark">Url Tiktok</label>
                    <input type="url" class="form-control" name="url_tiktok"
                        value="{{ old('url_tiktok', $setting['url_tiktok'] ?? '') }}" placeholder="https://tiktok.com/@...">
                </div>
            </div>
        </div>
       
        <button class="btn btn-custom-primary" type="submit">Simpan Pengaturan</button>
    </form>
@endsection
