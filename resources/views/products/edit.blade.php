@extends('layouts.app')
@section('title','Edit Product')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input name="title" class="form-control" value="{{ old('title',$product->title) }}" required>
                </div>
                <div class="form-group">
                    <label>Manufacturer</label>
                    <input name="manufacturer" class="form-control" value="{{ old('manufacturer',$product->manufacturer) }}" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        @php $s = old('status',$product->status); @endphp
                        <option value="in_stock"  {{ $s==='in_stock' ? 'selected':'' }}>In stock</option>
                        <option value="preorder" {{ $s==='preorder' ? 'selected':'' }}>Preorder</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    @php $t = old('type',$product->type); @endphp
                    <select name="type" class="form-control" required>
                        <option value="fuel" {{ $t==='fuel' ? 'selected':'' }}>Fuel</option>
                        <option value="oil"  {{ $t==='oil'  ? 'selected':'' }}>Oil</option>
                        <option value="air"  {{ $t==='air'  ? 'selected':'' }}>Air</option>
                        <option value="pump" {{ $t==='pump' ? 'selected':'' }}>Pump</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Power</label>
                    <input type="number" name="power" class="form-control" value="{{ old('power',$product->power) }}">
                </div>
                <div class="form-group">
                    <label>Image</label><br>
                    @if($product->img)
                        <img src="{{ asset('storage/'.$product->img) }}" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="img" class="form-control">
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
