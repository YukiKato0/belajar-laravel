@extends('admin.layout.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')
@section('subtitle', 'Tambahkan produk baru ke katalog')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 mb-0">Informasi Produk</h2>
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        @include('admin.product._form', ['action' => route('admin.product.store'), 'method' => 'POST'])
    </div>
</div>
@endsection
