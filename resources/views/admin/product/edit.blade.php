@extends('admin.layout.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')
@section('subtitle', 'Perbarui informasi produk')

@section('content')
<div class="card border-light shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 mb-0">{{ $product->name }}</h2>
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        @include('admin.product._form', ['action' => route('admin.product.update', $product), 'method' => 'PUT'])
    </div>
</div>
@endsection
