@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Subject List</h4>
                <a href="{{ route('create-subjects') }}" class="btn btn-light btn-sm">Add New Subject</a>
            </div>
            <div class="card-body table-responsive">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Subject Code</th>
                            <th scope="col">course year</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $index => $sub)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sub->subjectname }}</td>
                                <td>{{ $sub->subjectcode }}</td>
                                <td>{{ $sub->year_course }}</td>
                                <td>{{ $sub->description }}</td>
                                <td>
                                    <a href="{{ route('subjects-edit', $sub->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    {{-- Optional View/Delete buttons --}}
                                    {{-- <a href="{{ route('subjects-view', $sub->id) }}" class="btn btn-info btn-sm">View</a> --}}
                                    <form action="{{ route('delete-subject', $sub->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No subjects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
