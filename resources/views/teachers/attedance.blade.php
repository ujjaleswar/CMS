@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Take Attendance</h4>
                <a href="{{ route('attendance.list') }}" class="btn btn-light btn-sm">View shortlisted Students list</a>
            </div>
            <div class="card-body">

                <form action="{{ route('submit-Shortlisted') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Shortlisted</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $index => $student)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $student->full_name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <input type="hidden" name="students[{{ $student->id }}][id]"
                                                value="{{ $student->id }}">
                                            <select name="students[{{ $student->id }}][status]" class="form-select">
                                                <option value="Approved">Approved</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('student-view', $student->id) }}"
                                                class="btn btn-info btn-sm">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No students available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit Attendance</button>
                </form>
            </div>
        </div>
    </div>
@endsection
