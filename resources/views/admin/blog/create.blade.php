@extends('admin.layout.app')

@section('title', 'Tambah Artikel')
@section('page-title', 'Tambah Artikel')
@section('subtitle', 'Siapkan artikel baru untuk pembaca PrimaGraphia')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 mb-0">Informasi Artikel</h2>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        @include('admin.blog._form', ['action' => route('admin.blog.store'), 'method' => 'POST'])
    </div>
</div>
@endsection