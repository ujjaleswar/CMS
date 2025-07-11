@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">News Management</h2>
            <a class="btn btn-success" href="{{ route('News.create') }}">Create New</a>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Sl. No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $key => $blog)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $blog->title }}</td>
                        <td>{{ Str::limit($blog->description, 100) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('News.edits', $blog->id) }}">Edit</a>
                            <form action="{{ route('News.destroy', $blog->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No news available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
