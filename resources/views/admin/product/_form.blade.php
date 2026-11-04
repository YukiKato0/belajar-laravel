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
