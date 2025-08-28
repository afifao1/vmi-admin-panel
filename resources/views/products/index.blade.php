@extends('layouts.app')
@section('title','Products')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Products</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">+ Add Product</a>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead> … </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->manufacturer }}</td>
                        <td>{{ ucfirst($product->status) }}</td>
                        <td>{{ ucfirst($product->type) }}</td>
                        <td>{{ $product->power ?? '—' }}</td>
                        <td>
                            @if($product->img)
                                <img src="{{ asset('storage/'.$product->img) }}" width="60">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;">
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
