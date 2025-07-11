@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Student List</h4>
                {{-- <a href="{{ route('create-students') }}" class="btn btn-light btn-sm">Add New Student</a> --}}
            </div>

            <div class="card-body table-responsive ">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="GET" action="{{ route('student-list') }}" class="mb-3">
                    <div class="input-group " style="max-width: 300px;">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search by name">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>


                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>sl no</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>
                                    <a href="{{ route('student-edit', $student->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('student-view', $student->id) }}" class="btn btn-info btn-sm">View</a>
                                    <form action="{{ route('delete-student', $student->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No students found.</td>

                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
