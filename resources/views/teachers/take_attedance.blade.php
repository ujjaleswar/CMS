@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Take Attendance - {{ $subjectname }}</h4>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('submit-attendance') }}" method="POST">
                    @csrf

                    <input type="hidden" name="selected_date" value="{{ $date }}">
                    <input type="hidden" name="subjectname" value="{{ $subjectname }}">
                    <input type="hidden" name="class_name" value="{{ $class_name }}">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Attendance</th>
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

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="students[{{ $student->id }}][attendance]" value="Present"
                                                    id="present{{ $student->id }}" required>
                                                <label class="form-check-label"
                                                    for="present{{ $student->id }}">Present</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="students[{{ $student->id }}][attendance]" value="Absent"
                                                    id="absent{{ $student->id }}">
                                                <label class="form-check-label"
                                                    for="absent{{ $student->id }}">Absent</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="students[{{ $student->id }}][attendance]" value="Leave"
                                                    id="leave{{ $student->id }}">
                                                <label class="form-check-label"
                                                    for="leave{{ $student->id }}">Leave</label>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No students available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit Attendance</button>
                </form>
            </div>
        </div>
    </div>
@endsection
