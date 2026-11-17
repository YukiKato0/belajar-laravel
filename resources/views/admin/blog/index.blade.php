@extends('admin.layout.app')

@section('title', 'Manajemen Blog')
@section('page-title', 'Manajemen Blog')
@section('subtitle', 'Kelola artikel, jadwal, dan publikasi blog')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h5 mb-1">Daftar Artikel</h2>
                <p class="small text-muted mb-0">{{ $blogs->total() }} artikel tersimpan</p>
            </div>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-sm btn-custom-primary" aria-label="Tambah artikel" title="Tambah artikel">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Artikel</th>
                        <th>Kategori</th>
                        <th>Terbit</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ $blogs->firstItem() + $loop->index }}</td>
                        <td>
                            <span class="fw-semibold">{{ $blog->title }}</span>
                            <div class="small text-muted">/blog/{{ $blog->slug }}</div>
                        </td>
                        <td>{{ $blog->category }}</td>
                        <td>{{ $blog->published_at?->format('d M Y H:i') ?? 'Belum dijadwalkan' }}</td>
                        <td>
                            <span class="badge {{ $blog->is_published && $blog->published_at?->isPast() ? 'bg-success' : 'bg-secondary' }}">
                                {{ $blog->is_published && $blog->published_at?->isPast() ? 'Terbit' : 'Draft' }}
                            </span>
                        </td>
                        <td class="text-center text-nowrap">
                            @if ($blog->is_published && $blog->published_at?->isPast())
                            <a href="{{ route('blogs.show', ['blog' => $blog->slug]) }}" target="_blank" class="btn btn-sm btn-outline-primary" aria-label="Pratinjau {{ $blog->title }}" title="Pratinjau publik">
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                            @endif
                            <a href="{{ route('admin.blog.edit', $blog) }}" class="btn btn-sm btn-custom-warning" aria-label="Edit {{ $blog->title }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.blog.destroy', $blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-custom-danger" aria-label="Hapus {{ $blog->title }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada artikel.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $blogs->links() }}
    </div>
</div>
@endsection