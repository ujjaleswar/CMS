@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Attendance</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('shortlisted.update', $attendance->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Student Name:</label>
                        <input type="text" class="form-control" value="{{ $attendance->student->full_name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" value="{{ $attendance->student->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Shortlisted Status:</label>
                        <select name="status" class="form-select">
                            <option value="Approved" {{ $attendance->status == 'Approved' ? 'selected' : '' }}>Approved
                            </option>
                            <option value="Pending" {{ $attendance->status == 'Pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="Rejected" {{ $attendance->status == 'Rejected' ? 'selected' : '' }}>Rejected
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Attendance</button>
                </form>

            </div>
        </div>
    </div>
@endsection
