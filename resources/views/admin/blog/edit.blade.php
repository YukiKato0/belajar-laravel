@extends('admin.layout.app')

@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')
@section('subtitle', 'Perbarui konten dan pengaturan publikasi artikel')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 mb-0">{{ $blog->title }}</h2>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        @include('admin.blog._form', ['action' => route('admin.blog.update', $blog), 'method' => 'PUT'])
    </div>
</div>
@endsection