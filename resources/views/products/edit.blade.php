@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section id="dashboard-analytics">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
                            @csrf
                            @if(isset($product))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" name="category" class="form-control" value="{{ old('category', $product->category ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                @if (Auth::user()->branch_id) <!-- Check if the authenticated user has a branch_id -->
                                    <input type="hidden" name="branch_id" value="{{ Auth::user()->branch_id }}">
                                    <p class="form-control-plaintext">{{ Auth::user()->branch->branch_name }}</p> <!-- Display the branch name -->
                                @else
                                    <select name="branch_id" class="form-control">
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->branch_id }}" {{ (isset($product) && $product->branch_id == $branch->branch_id) ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update Product' : 'Create Product' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection