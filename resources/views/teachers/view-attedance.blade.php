@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Shortlisted Student List</h4>
                <a href="{{ route('teacher-attendance') }}" class="btn btn-light btn-sm">Verify student</a>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    {{-- <h5 class="text-center">Date: <strong>{{ \Carbon\Carbon::now()->toDateString() }}</strong></h5> --}}
                </div>

                <div class="table-responsive">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Sl. No</th>
                                <th>Student Name</th>
                                <th>Shortlisted</th>
                                <th>Action</th> {{-- New Column --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $index => $attendance)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $attendance->student->full_name }}</td>
                                    <td class="text-capitalize">{{ $attendance->status }}</td>
                                    <td>
                                        <a href="{{ route('shortlisted.edit', $attendance->id) }}"
                                            class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                        <form action="{{ route('shortlisted.destroy', $attendance->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No attendance records found for today.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
