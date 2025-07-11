<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Attendance for {{ $schedule->date }}</h4>
                {{-- <a href="{{ route('student-list') }}" class="btn btn-light btn-sm">Back to Student List</a> --}}
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>sl no</th>
                            <th>Student Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $serial = 1; @endphp
                        @forelse ($attendanceList as $attendance)
                            @php
                                $attendances = json_decode($attendance->attendance, true);
                            @endphp
                            @foreach ($attendances as $studentId => $statusCode)
                                @php
                                    $student = \App\Models\Students::find($studentId);
                                    $status = match ($statusCode) {
                                        1 => 'Present',
                                        0 => 'Absent',
                                        2 => 'Leave',
                                        default => 'Unknown',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $serial++ }}</td>
                                    <td>{{ $student->full_name ?? 'N/A' }}</td>
                                    <td>{{ $status }}</td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No attendance records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>
