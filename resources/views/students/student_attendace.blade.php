@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Load Student List</h4>
            </div>

            <div class="card-body">
                <form method="POST" id="attendanceForm">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Academic Year</label>
                            <select name="applied_year" class="form-select academic_year" required>
                                <option selected disabled>Choose...</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Subject</label>
                            <select name="teacherSubject" class="form-select subject" required>
                                <option selected disabled>Choose...</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-primary addbtn">Load Students</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Student Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="newrow text-center">
                                <!-- Dynamically loaded students -->
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let rowCount = 1;

            // Dynamically load subjects based on academic year
            $('.academic_year').on('change', function() {
                const yearId = $(this).val();
                const subjectDropdown = $('.subject');
                subjectDropdown.html('<option selected disabled>Choose...</option>');

                if (yearId) {
                    $.get(`/get-subjects/${yearId}`, function(subjects) {
                        if (subjects.length > 0) {
                            $.each(subjects, function(i, subject) {
                                subjectDropdown.append(
                                    `<option value="${subject.id}">${subject.subjectname}</option>`
                                );
                            });
                        }
                    });
                }
            });

            // Load students when clicking 'Load Students'
            $('.addbtn').on('click', function() {
                const yearId = $('.academic_year').val();
                const subjectId = $('.subject').val();

                if (!yearId || !subjectId) {
                    alert("Please select both Academic Year and Subject.");
                    return;
                }

                $.get(`/get-students?year_id=${yearId}`, function(students) {
                    $('.newrow').empty();
                    rowCount = 1;

                    if (students.length > 0) {
                        $.each(students, function(index, student) {
                            $('.newrow').append(`
                        <tr>
                            <td>${rowCount++}</td>
                            <td>
                                ${student.full_name}
                                <input type="hidden" name="student_ids[]" value="${student.id}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm check-row"
                                        data-student="${student.id}">Check</button>
                            </td>
                        </tr>
                    `);
                        });
                    } else {
                        $('.newrow').html('<tr><td colspan="3">No students found.</td></tr>');
                    }
                });
            });

            // Open checked attendance in new tab
            $(document).on('click', '.check-row', function() {
                const studentId = $(this).data('student');
                const yearId = $('.academic_year').val();
                const subjectId = $('.subject').val();

                if (!studentId || !yearId || !subjectId) return;

                $.get(`/get-attendance?year_id=${yearId}&student_id=${studentId}&subject_id=${subjectId}`,
                    function(data) {
                        const newTab = window.open('', '_blank');

                        let html = `
                <html>
                <head>
                    <title>Checked Attendance</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body>
                    <div class="container mt-5">
                        <h4 class="mb-4">Checked Students (Attendance Already Taken)</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-info">
                                    <tr>
                                        <th>Sl. No</th>
                                        <th>Student Name</th>
                                        <th>Date</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                        if (data.length > 0) {
                            let sn = 1;
                            data.forEach(row => {
                                html += `
                        <tr>
                            <td>${sn++}</td>
                            <td>${row.name}</td>
                            <td>${row.date}</td>
                            <td>${row.status}</td>
                        </tr>`;
                            });
                        } else {
                            html += `
                    <tr>
                        <td colspan="4">No attendance found for this student.</td>
                    </tr>`;
                        }

                        html += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                </body>
                </html>`;

                        newTab.document.write(html);
                        newTab.document.close();
                    });
            });
        });
    </script>
@endsection
