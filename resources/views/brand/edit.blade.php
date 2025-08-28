@extends('layouts.app')
@section('title','Edit Brand')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Brand</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control" value="{{ old('name', $brand->name) }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Image</label><br>
                    @if($brand->image)
                        <img src="{{ asset('storage/'.$brand->image) }}" width="100" class="mb-2" alt="brand"><br>
                    @endif
                    <input type="file" name="image" class="form-control">
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
