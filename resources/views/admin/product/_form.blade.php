<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="row g-3">
        <div class="col-md-8">
            <label for="name" class="form-label">Nama Produk</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name ?? '') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="category_id" class="form-label">Kategori</label>
            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">Pilih kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="sku" class="form-label">SKU</label>
            <input id="sku" name="sku" type="text" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku ?? '') }}" placeholder="Dibuat otomatis jika kosong">
            @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="detail_badge" class="form-label">Badge Detail</label>
            <input id="detail_badge" name="detail_badge" type="text" maxlength="100" class="form-control @error('detail_badge') is-invalid @enderror" value="{{ old('detail_badge', $product->detail_badge ?? '') }}" placeholder="Produk Unggulan">
            @error('detail_badge')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="image_url" class="form-label">URL Gambar Produk</label>
            <input id="image_url" name="image_url" type="url" class="form-control @error('image_url') is-invalid @enderror" value="{{ old('image_url', $product->image_url ?? '') }}" placeholder="https://...">
            @error('image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input id="price" name="price" type="number" min="0" step="1" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price ?? '') }}" required>
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="price_unit" class="form-label">Satuan Harga</label>
            <input id="price_unit" name="price_unit" type="text" maxlength="30" class="form-control @error('price_unit') is-invalid @enderror" value="{{ old('price_unit', $product->price_unit ?? 'pcs') }}" placeholder="pcs, set, box" required>
            @error('price_unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="sort_order" class="form-label">Urutan Tampil</label>
            <input id="sort_order" name="sort_order" type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
            @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="icon_class" class="form-label">Kelas Ikon Bootstrap</label>
            <input id="icon_class" name="icon_class" type="text" maxlength="100" class="form-control @error('icon_class') is-invalid @enderror" value="{{ old('icon_class', $product->icon_class ?? 'bi bi-box-seam') }}" placeholder="bi bi-box-seam">
            @error('icon_class')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="rating" class="form-label">Rating (0-5)</label>
            <input id="rating" name="rating" type="number" min="0" max="5" step="0.1" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', $product->rating ?? 0) }}">
            @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="review_count" class="form-label">Jumlah Ulasan</label>
            <input id="review_count" name="review_count" type="number" min="0" class="form-control @error('review_count') is-invalid @enderror" value="{{ old('review_count', $product->review_count ?? 0) }}">
            @error('review_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="sold_count" class="form-label">Jumlah Terjual</label>
            <input id="sold_count" name="sold_count" type="number" min="0" class="form-control @error('sold_count') is-invalid @enderror" value="{{ old('sold_count', $product->sold_count ?? 0) }}">
            @error('sold_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="minimum_order" class="form-label">Minimum Pesanan</label>
            <input id="minimum_order" name="minimum_order" type="number" min="1" class="form-control @error('minimum_order') is-invalid @enderror" value="{{ old('minimum_order', $product->minimum_order ?? 1) }}">
            @error('minimum_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="production_time" class="form-label">Estimasi Produksi</label>
            <input id="production_time" name="production_time" type="text" maxlength="100" class="form-control @error('production_time') is-invalid @enderror" value="{{ old('production_time', $product->production_time ?? '') }}" placeholder="1-2 hari kerja">
            @error('production_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <label for="detail_highlights_json" class="form-label">Highlight Detail (JSON array)</label>
            <textarea id="detail_highlights_json" name="detail_highlights_json" rows="4" class="form-control font-monospace @error('detail_highlights_json') is-invalid @enderror" placeholder='[{"title":"Art Carton 310gsm","description":"Kertas tebal dan kokoh","icon":"bi bi-patch-check-fill"}]'>{{ old('detail_highlights_json', isset($product) && $product->detail_highlights ? json_encode($product->detail_highlights, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '') }}</textarea>
            @error('detail_highlights_json')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <label for="file_requirements" class="form-label">Panduan File Desain</label>
            <textarea id="file_requirements" name="file_requirements" rows="4" class="form-control @error('file_requirements') is-invalid @enderror" placeholder="PDF, AI, CDR; mode CMYK; resolusi 300 DPI">{{ old('file_requirements', $product->file_requirements ?? '') }}</textarea>
            @error('file_requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="template_pdf_url" class="form-label">URL Template PDF</label>
            <input id="template_pdf_url" name="template_pdf_url" type="url" class="form-control @error('template_pdf_url') is-invalid @enderror" value="{{ old('template_pdf_url', $product->template_pdf_url ?? '') }}">
            @error('template_pdf_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="template_ai_url" class="form-label">URL Template AI</label>
            <input id="template_ai_url" name="template_ai_url" type="url" class="form-control @error('template_ai_url') is-invalid @enderror" value="{{ old('template_ai_url', $product->template_ai_url ?? '') }}">
            @error('template_ai_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="template_psd_url" class="form-label">URL Template PSD</label>
            <input id="template_psd_url" name="template_psd_url" type="url" class="form-control @error('template_psd_url') is-invalid @enderror" value="{{ old('template_psd_url', $product->template_psd_url ?? '') }}">
            @error('template_psd_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <label for="configuration_json" class="form-label">Konfigurasi Opsi Cetak dan Harga (JSON)</label>
            <textarea id="configuration_json" name="configuration_json" rows="9" class="form-control font-monospace @error('configuration_json') is-invalid @enderror" placeholder='{"materials":[{"name":"Art Carton 310gsm","price":45000}],"sides":[{"name":"1 sisi","price":0}],"finishes":[{"name":"Spot UV","price":20000}],"discounts":[{"minimum":5,"percent":15}]}'>{{ old('configuration_json', isset($product) && $product->configuration ? json_encode($product->configuration, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '') }}</textarea>
            @error('configuration_json')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12 d-flex flex-wrap gap-4">
            <div class="form-check">
                <input type="hidden" name="is_new" value="0">
                <input id="is_new" name="is_new" type="checkbox" value="1" class="form-check-input" @checked(old('is_new', $product->is_new ?? false))>
                <label for="is_new" class="form-check-label">Produk baru</label>
            </div>
            <div class="form-check">
                <input type="hidden" name="is_best_seller" value="0">
                <input id="is_best_seller" name="is_best_seller" type="checkbox" value="1" class="form-check-input" @checked(old('is_best_seller', $product->is_best_seller ?? false))>
                <label for="is_best_seller" class="form-check-label">Produk terlaris</label>
            </div>
            <div class="form-check">
                <input type="hidden" name="is_active" value="0">
                <input id="is_active" name="is_active" type="checkbox" value="1" class="form-check-input" @checked(old('is_active', $product->is_active ?? true))>
                <label for="is_active" class="form-check-label">Tampilkan di katalog</label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('admin.product.index') }}" class="btn btn-light">Batal</a>
        <button type="submit" class="btn btn-custom-primary">{{ $method === 'POST' ? 'Simpan Produk' : 'Perbarui Produk' }}</button>
    </div>
</form>
