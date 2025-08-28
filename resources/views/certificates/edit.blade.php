@extends('layouts.app')
@section('title','Edit Certificate')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Certificate</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Title (optional)</label>
                    <input name="title" class="form-control" value="{{ old('title',$certificate->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>File</label><br>
                    @if($certificate->image)
                        @if(\Illuminate\Support\Str::endsWith($certificate->image, '.pdf'))
                            <a href="{{ asset('storage/'.$certificate->image) }}" target="_blank">Current PDF</a><br>
                        @else
                            <img src="{{ asset('storage/'.$certificate->image) }}" width="100" class="mb-2">
                        @endif
                    @endif
                    <input type="file" name="image" class="form-control">
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
