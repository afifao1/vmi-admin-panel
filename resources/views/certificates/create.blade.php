@extends('layouts.app')
@section('title','Add Certificate')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Add Certificate</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title (optional)</label>
                    <input name="title" class="form-control" value="{{ old('title') }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>File (jpg, png, pdf)</label>
                    <input type="file" name="image" class="form-control" required>
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
