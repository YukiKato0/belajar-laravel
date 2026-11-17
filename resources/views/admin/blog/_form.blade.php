<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="row g-3">
        <div class="col-md-8">
            <label for="title" class="form-label">Judul Artikel</label>
            <input id="title" name="title" type="text" maxlength="255" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title ?? '') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="category" class="form-label">Kategori</label>
            <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
                @foreach (['Product', 'Tips & Trick', 'Event & Activation', 'Promo'] as $category)
                    <option value="{{ $category }}" @selected(old('category', $blog->category ?? 'Product') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-8">
            <label for="slug" class="form-label">Slug URL</label>
            <input id="slug" name="slug" type="text" maxlength="255" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $blog->slug ?? '') }}" placeholder="Dibuat otomatis dari judul">
            <div class="form-text">URL artikel: /blog/[slug]</div>
            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label for="read_time" class="form-label">Waktu Baca (menit)</label>
            <input id="read_time" name="read_time" type="number" min="1" max="120" class="form-control @error('read_time') is-invalid @enderror" value="{{ old('read_time', $blog->read_time ?? 3) }}" required>
            @error('read_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <label for="excerpt" class="form-label">Ringkasan</label>
            <textarea id="excerpt" name="excerpt" rows="2" maxlength="500" class="form-control @error('excerpt') is-invalid @enderror" required>{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
            @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label for="author_name" class="form-label">Nama Penulis</label>
            <input id="author_name" name="author_name" type="text" maxlength="255" class="form-control @error('author_name') is-invalid @enderror" value="{{ old('author_name', $blog->author_name ?? 'Tim PrimaGraphia') }}" required>
            @error('author_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label for="published_at" class="form-label">Tanggal Publikasi</label>
            <input id="published_at" name="published_at" type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at', isset($blog) && $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
            @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label for="featured_image_url" class="form-label">URL Gambar Utama</label>
            <input id="featured_image_url" name="featured_image_url" type="url" maxlength="2048" class="form-control @error('featured_image_url') is-invalid @enderror" value="{{ old('featured_image_url', $blog->featured_image_url ?? '') }}" placeholder="https://...">
            @error('featured_image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label for="author_image_url" class="form-label">URL Foto Penulis</label>
            <input id="author_image_url" name="author_image_url" type="url" maxlength="2048" class="form-control @error('author_image_url') is-invalid @enderror" value="{{ old('author_image_url', $blog->author_image_url ?? '') }}" placeholder="https://...">
            @error('author_image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <label for="content" class="form-label">Isi Artikel (Markdown)</label>
            <textarea id="content" name="content" rows="20" maxlength="50000" class="form-control font-monospace @error('content') is-invalid @enderror" required placeholder="# Judul bagian&#10;&#10;Tulis isi artikel di sini...">{{ old('content', $blog->content ?? '') }}</textarea>
            <div class="form-text">Gunakan # untuk judul, **tebal**, *miring*, dan format Markdown lainnya.</div>
            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <div class="form-check">
                <input type="hidden" name="is_published" value="0">
                <input id="is_published" name="is_published" type="checkbox" value="1" class="form-check-input" @checked(old('is_published', $blog->is_published ?? false))>
                <label for="is_published" class="form-check-label">Publikasikan artikel</label>
                <div class="form-text">Artikel baru hanya tampil pada website publik jika opsi ini aktif dan tanggal publikasi sudah tiba.</div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('admin.blog.index') }}" class="btn btn-light">Batal</a>
        <button type="submit" class="btn btn-custom-primary">{{ $method === 'POST' ? 'Simpan Artikel' : 'Perbarui Artikel' }}</button>
    </div>
</form>