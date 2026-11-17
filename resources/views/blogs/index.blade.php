@extends('layout.app')

@section('title', 'Semua Blog | PrimaGraphia')

@section('content')
<div class="flex flex-col w-full">
  <div class="bg-light border-bottom py-2"><div class="container"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 py-1" style="font-size: 0.85rem;"><li class="breadcrumb-item"><a class="text-decoration-none text-muted" href="{{ route('home') }}"><i class="bi bi-house-door"></i> Beranda</a></li><li aria-current="page" class="breadcrumb-item active text-primary fw-semibold">Blog</li></ol></nav></div></div>
  <section class="py-4 py-lg-5 bg-white border-bottom">
    <div class="container">
      <div class="row align-items-end g-4">
        <div class="col-lg-7">
          <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-light text-primary fw-semibold mb-3 border" style="font-size: 0.8rem;"><i class="bi bi-journal-text text-danger"></i> Blog &amp; Edukasi</div>
          <h1 class="display-6 fw-bold text-dark mb-3 lh-sm">Artikel &amp; tips cetak</h1>
          <p class="text-muted fs-6 mb-0 lh-base">Panduan bahan, finishing, dan ide promosi dari tim PrimaGraphia.</p>
        </div>
        <div class="col-lg-5">
          <form class="blog-search" role="search" method="GET" action="{{ route('blogs.index') }}">
            <label class="form-label small fw-semibold text-muted" for="blogSearchInput">Cari artikel</label>
            <div class="input-group shadow-sm rounded-pill overflow-hidden border"><span class="input-group-text bg-white border-0 text-muted ps-3"><i class="bi bi-search"></i></span><input autocomplete="off" class="form-control border-0 ps-1" id="blogSearchInput" name="q" value="{{ $search }}" maxlength="100" placeholder="Cari artikel, mis. stiker, banner…" style="font-size: 0.9rem;" type="search" /><button class="btn btn-pg-primary" type="submit">Cari</button></div>
          </form>
        </div>
      </div>
      <div class="pg-category-pills mt-4" aria-label="Kategori artikel" role="group">
        <a class="pill-filter-btn {{ $category === '' ? 'active' : '' }}" href="{{ route('blogs.index', array_filter(['q' => $search])) }}">Semua <span class="opacity-75 ms-1">{{ $totalPublished }}</span></a>
        @foreach ($categories as $categoryName)
          <a class="pill-filter-btn {{ $category === $categoryName ? 'active' : '' }}" href="{{ route('blogs.index', array_filter(['category' => $categoryName, 'q' => $search])) }}">{{ $categoryName }} <span class="opacity-75 ms-1">{{ $categoryCounts[$categoryName] }}</span></a>
        @endforeach
      </div>
    </div>
  </section>
  <section class="py-5 bg-light" id="artikel">
    <div class="container">
      @if ($featuredBlog)
      <article class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 blog-item blog-featured">
        <div class="row g-0 align-items-stretch">
          <div class="col-lg-7"><a class="ratio ratio-3x2 d-block h-100 bg-light blog-card-media" href="{{ route('blogs.show', ['blog' => $featuredBlog->slug]) }}" tabindex="-1" aria-hidden="true">@if ($featuredBlog->featured_image_url)<img alt="{{ $featuredBlog->title }}" class="object-fit-cover" fetchpriority="high" src="{{ $featuredBlog->featured_image_url }}" />@endif</a></div>
          <div class="col-lg-5 d-flex"><div class="card-body p-4 p-xl-5 d-flex flex-column justify-content-center">
            <span class="badge bg-danger rounded-pill align-self-start px-3 py-2 mb-3"><i class="bi bi-stars me-1"></i>Artikel terbaru</span>
            <div class="d-flex flex-wrap align-items-center gap-2 text-muted small mb-2"><span class="text-primary fw-semibold">{{ $featuredBlog->category }}</span><span aria-hidden="true">·</span><time datetime="{{ $featuredBlog->published_at->toDateString() }}">{{ $featuredBlog->published_at->format('d M Y') }}</time><span aria-hidden="true">·</span><span>{{ $featuredBlog->read_time }} menit baca</span></div>
            <h2 class="h3 fw-bold lh-sm mb-3"><a class="text-dark" href="{{ route('blogs.show', ['blog' => $featuredBlog->slug]) }}">{{ $featuredBlog->title }}</a></h2>
            <p class="text-muted mb-4">{{ $featuredBlog->excerpt }}</p>
            <a class="btn btn-pg-primary rounded-pill px-4 py-2 fw-semibold align-self-start d-inline-flex align-items-center gap-2" href="{{ route('blogs.show', ['blog' => $featuredBlog->slug]) }}">Baca artikel <i class="bi bi-arrow-right"></i></a>
          </div></div>
        </div>
      </article>
      @endif
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="blogGrid">
        @forelse ($blogs as $blog)
        <div class="col blog-item" data-category="{{ \Illuminate\Support\Str::slug($blog->category) }}"><article class="article-card blog-card">
          <a class="ratio ratio-3x2 d-block overflow-hidden bg-light blog-card-media" href="{{ route('blogs.show', ['blog' => $blog->slug]) }}" tabindex="-1" aria-hidden="true">@if ($blog->featured_image_url)<img alt="{{ $blog->title }}" class="object-fit-cover" loading="lazy" src="{{ $blog->featured_image_url }}" />@endif</a>
          <div class="p-3 p-lg-4 d-flex flex-column flex-grow-1"><div class="d-flex flex-wrap align-items-center gap-2 text-muted small mb-2"><span class="text-primary fw-semibold">{{ $blog->category }}</span><span aria-hidden="true">·</span><time datetime="{{ $blog->published_at->toDateString() }}">{{ $blog->published_at->format('d M Y') }}</time><span aria-hidden="true">·</span><span>{{ $blog->read_time }} menit baca</span></div>
            <h2 class="h6 fw-bold mb-2 lh-sm"><a class="text-dark stretched-link-title" href="{{ route('blogs.show', ['blog' => $blog->slug]) }}">{{ $blog->title }}</a></h2><p class="text-muted small mb-3 flex-grow-1 blog-excerpt">{{ $blog->excerpt }}</p><a class="text-primary fw-bold small d-inline-flex align-items-center gap-1 mt-auto" href="{{ route('blogs.show', ['blog' => $blog->slug]) }}">Baca artikel <i class="bi bi-arrow-right"></i></a>
          </div>
        </article></div>
        @empty
          @unless ($featuredBlog)<div class="col-12"><p class="text-center text-muted py-5 mb-0">Belum ada artikel yang cocok.</p></div>@endunless
        @endforelse
      </div>
      <div class="mt-4">{{ $blogs->links() }}</div>
    </div>
  </section>
</div>
@endsection