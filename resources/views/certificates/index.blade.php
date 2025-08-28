@extends('layouts.app')
@section('title','Certificates')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Certificates</h1>

    <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary mb-3">+ Add Certificate</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>File</th>
                    <th width="160">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($certificates as $certificate)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $certificate->title ?? '—' }}</td>
                        <td>
                            @if(\Illuminate\Support\Str::endsWith($certificate->image, '.pdf'))
                                <a href="{{ asset('storage/'.$certificate->image) }}" target="_blank">View PDF</a>
                            @else
                                <img src="{{ asset('storage/'.$certificate->image) }}" width="80" alt="certificate">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.certificates.edit', $certificate) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.certificates.destroy', $certificate) }}"
                                  method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
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
