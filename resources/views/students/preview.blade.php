<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .student-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0d6efd;
            background-color: white;
        }

        .table th {
            width: 30%;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3>Student Application</h3>
            </div>

            <div class="card-body">
                @if ($student)
                    <h5 class="text-primary mb-3">Student Information</h5>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $student->full_name ?? 'N/A' }}</td>
                                <th>Photo</th>
                                <td>
                                    @if ($student->photo_path)
                                        <img src="{{ asset($student->photo_path) }}" alt="Student Photo"
                                            class="student-photo shadow">
                                    @else
                                        <span class="text-danger">No photo available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $student->email ?? 'N/A' }}</td>
                                <th>Phone</th>
                                <td>{{ $student->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $student->dob ?? 'N/A' }}</td>
                                <th>Gender</th>
                                <td>{{ $student->gender ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td>{{ $student->father_name ?? 'N/A' }}</td>
                                <th>Mother's Name</th>
                                <td>{{ $student->mother_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{ $student->nationality ?? 'N/A' }}</td>
                                <th>Religion</th>
                                <td>{{ $student->religion ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $student->address ?? 'N/A' }}</td>
                                <th>Course Applied</th>
                                <td>{{ $student->course ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Qualification</th>
                                <td>{{ $student->qualification ?? 'N/A' }}</td>
                                <th>ID Proof</th>
                                <td>
                                    @if ($student->id_proof_path)
                                        <img src="{{ asset($student->id_proof_path) }}" alt="ID Proof" width="100"
                                            class="img-thumbnail">
                                    @else
                                        <span class="text-danger">No ID proof</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>percetage</th>
                                <td>{{ $student->percetage ?? 'N/A' }}</td>
                                <th>course year</th>
                                <td>
                                    {{ $student->course_year ?? 'N/A' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning text-center">
                        No student data available.
                    </div>
                @endif
            </div>

            @if ($student)
                <div class="text-center mb-5">
                    <a href="{{ route('studentlist.download', $student->id) }}" target="_blank" class="btn btn-primary"
                        onclick="setTimeout(() => { window.location.href = '{{ route('landingpage') }}'; }, 2000);">
                        Download Application
                    </a>

                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
