@extends('admin.layout.app')

@section('page-title', 'Pengaturan Website')
@section('subtitle', 'Konfigurasi indentitas website, logo, kontak dan informasi profil')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <ul class="nav nav-tabs mb-3" id="defaultTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                    <i class="bi bi-house-door me-1"></i> Pengaturan Umum
                </button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false" tabindex="-1">
                    <i class="bi bi-person me-1"></i> Profile
                </button>
            </li> -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kontak-lokasi-tab" data-bs-toggle="tab" data-bs-target="#kontak-lokasi-tab-pane"
                    type="button" role="tab" aria-controls="kontak-lokasi-tab-pane" aria-selected="false" tabindex="-1">
                    <i class="bi bi-chat-dots me-1"></i> Kontak Lokasi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sosial-media-tab" data-bs-toggle="tab" data-bs-target="#sosial-media-tab-pane"
                    type="button" role="tab" aria-controls="sosial-media-tab-pane" aria-selected="false" tabindex="-1">
                    <i class="bi bi-chat-dots me-1"></i> Sosial Media
                </button>
            </li>
        </ul>

        <div class="tab-content text-muted-green small mb-4" id="defaultTabsContent">
            <div class="tab-pane fade active show mt-4" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <h5 class="mb-3">Pengaturan Umum</h5>

              <div class="mb-3">
                <label for="" class>Site Name</label>
                <input type="text" class="form-control" name="site_name"
                  value="{{ old('site_name', $setting['site_name']->value) }}">
              </div>
              <div class="mb-3">
                <label for="" class>Site Tagline</label>
                <input type="text" class="form-control" name="site_tagline"
                  value="">
              </div>
              <div class="mb-3">
                <label for="" class>Site Description</label>
                <input type="text" class="form-control" name="site_description"
                  value="">
              </div>
              <div class="mb-3">
                <label for="" class>Site Logo</label>
                <input type="text" class="form-control" name="site_logo"
                  value="">
              </div>
            </div>

            <div class="tab-pane fade mt-4" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
              <h5>Pengaturan Umum</h5>

              <div class="mb-3">
                <label for="" class></label>
                <input type="text" class="form-control" name="site_name" value="site_name">
              </div>
            </div>
            
            <div class="tab-pane fade mt-4" id="kontak-lokasi-tab-pane" role="tabpanel" aria-labelledby="kontak-lokasi-tab" tabindex="0">
              <h5 class="mb-3">Kontak & Lokasi</h5>

              <div class="mb-3">
                <label for="" class>Nomor Telepon Utama</label>
                <input type="number" class="form-control" name="phone" value="">
              </div>
              <div class="mb-3">
                <label for="" class>Email Upload</label>
                <input type="number" class="form-control" name="email_upload" value="">
              </div>
              <div class="mb-3">
                <label for="" class>Email Order</label>
                <input type="number" class="form-control" name="email_order" value="">
              </div>
              <div class="mb-3">
                <label for="" class>Alamat</label>
                <textarea name="address" id="" cols="35" class="form-control"></textarea>
              </div>
            </div>

            <div class="tab-pane fade mt-4" id="sosial-media-tab-pane" role="tabpanel" aria-labelledby="sosial-media-tab" tabindex="0">
              <h5 class="mb-3">Sosial Media</h5>

              <div class="mb-3">
                <label for="" class>Url Shopee</label>
                <input type="text" class="form-control" name="url_shopee" value="">
              </div>
              <div class="mb-3">
                <label for="" class>Url Facbook</label>
                <input type="text" class="form-control" name="url_facbook" value="">
              </div>
              <div class="mb-3">
                <label for="" class>Url Instagram</label>
                <input type="text" class="form-control" name="url_instagram" value="">
              </div>
              <div class="mb-3">
                <label for="" class>Url YouTube</label>
                <input type="text" class="form-control" name="url_youtube" value="">
              </div>
              <div class="mb-3">
                <label for="" class>Url Tiktok</label>
                <input type="text" class="form-control" name="url_tiktok" value="">
              </div>
            </div>
        </div>

        <button class="btn-custom btn-custom-primary" type="submit">Primary Button</button>
    </form>
@endsection