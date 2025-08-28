@extends('layouts.app')
@section('title','Add Product')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Add Product</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input name="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Manufacturer</label>
                    <input name="manufacturer" class="form-control" value="{{ old('manufacturer') }}" required>
                    @error('manufacturer') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control select-enhanced" required>
                        <option value="in_stock"  {{ old('status','in_stock')==='in_stock' ? 'selected':'' }}>In stock</option>
                        <option value="preorder" {{ old('status')==='preorder' ? 'selected':'' }}>Preorder</option>
                    </select>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-control select-enhanced" required>
                        <option value="fuel" {{ old('type','fuel')==='fuel' ? 'selected':'' }}>Fuel</option>
                        <option value="oil"  {{ old('type')==='oil'  ? 'selected':'' }}>Oil</option>
                        <option value="air"  {{ old('type')==='air'  ? 'selected':'' }}>Air</option>
                        <option value="pump" {{ old('type')==='pump' ? 'selected':'' }}>Pump</option>
                    </select>
                    @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="form-group">
                    <label>Image (optional)</label>
                    <input type="file" name="img" class="form-control">
                    @error('img') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>

        .select2-container .select2-selection--single { height: calc(1.5em + .75rem + 2px); }
        .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: calc(1.5em + .75rem); }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: calc(1.5em + .75rem); }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $('.select-enhanced').select2({
                width: '100%',
                minimumResultsForSearch: 0
            });
        });
    </script>
@endpush
