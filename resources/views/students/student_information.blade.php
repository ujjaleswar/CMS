@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Student Details</h4>
            </div>

            <div class="card-body table-responsive">
                @if ($student)
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $student->student->full_name ?? 'N/A' }}</td>
                                <td>{{ $student->student->email ?? 'N/A' }}</td>
                                <td>{{ $student->student->phone ?? 'N/A' }}</td>
                                <td>{{ $student->student->course_year ?? 'N/A' }}</td>
                                <td>
                                    {{ $attendance->status ?? 'N/A' }}</td>
                                </td>
                                <td>
                                    <a href="{{ route('student-view', $student->student->id) }}"
                                        class="btn btn-info btn-sm">view</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">No student found.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
