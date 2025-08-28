@extends('layouts.app')
@section('title','Brands')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Brands</h1>

    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-3">+ Add Brand</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width:60px">#</th>
                    <th>Name</th>
                    <th style="width:120px">Image</th>
                    <th style="width:180px">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brands as $brand)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            @if($brand->image)
                                <img src="{{ asset('storage/'.$brand->image) }}" width="80" alt="brand">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
