@extends('layouts.app')

@push('styles')
    <style>
        .calendar-date.today {
            background-color: #b497b2 !important;
            color: #000;
            font-weight: bold;
            border: 2px solid #000;
            border-radius: 50%;
        }

        .schedule-count {
            background-color: #28a745;
            color: #fff;
            font-size: 12px;
            width: 20px;
            height: 20px;
            line-height: 20px;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
            position: absolute;
            top: 2px;
            right: 2px;
        }

        .calendar-date {
            position: relative;
            height: 60px;
            vertical-align: top;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-3">
        <a href="{{ route('teacher.data', $teacher->id) }}" class="btn btn-success btn-sm mb-2">All Schedule List</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between">
                        <button class="btn btn-sm btn-light" id="prevMonth">&lt;</button>
                        <h5 class="mb-0" id="calendarTitle">Loading...</h5>
                        <button class="btn btn-sm btn-light" id="nextMonth">&gt;</button>
                    </div>
                    <div class="card-body p-2" id="calendarTable" data-teacher-id="{{ $teacher->id }}"></div>
                </div>
            </div>

            <div class="col-md-6" id="shedule_section" style="max-height: 500px; overflow-y: auto;">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Schedule Details</h5>
                    </div>
                    <div class="card-body">
                        <div id="scheduleWrapper"></div>
                        <div class="mt-3" id="scheduleResults">
                            <p>Select a date to view schedules.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentDate = new Date();
        const scheduleCounts = @json($scheduleCounts);
        const teacherId = {{ $teacher->id }};

        function renderCalendar(year, month) {
            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            $('#calendarTitle').text(`${monthNames[month]} ${year}`);
            const today = new Date();
            const isThisMonth = today.getFullYear() === year && today.getMonth() === month;

            let table = `<table class="table table-bordered text-center mb-0">
            <thead class="table-primary">
                <tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>
            </thead>
            <tbody><tr>`;

            let day = 1;
            for (let i = 0; i < 6; i++) {
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        table += '<td></td>';
                    } else if (day > lastDate) {
                        table += '<td></td>';
                    } else {
                        const dateStr = `${year}-${String(month+1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                        const isToday = isThisMonth && day === today.getDate();
                        const highlightClass = isToday ? 'today' : '';
                        const countCircle = scheduleCounts[dateStr] ?
                            `<div class="schedule-count">${scheduleCounts[dateStr]}</div>` : '';
                        table +=
                            `<td class="calendar-date ${highlightClass}" data-date="${dateStr}">${day}${countCircle}</td>`;
                        day++;
                    }
                }
                table += '</tr>';
                if (day > lastDate) break;
                if (i < 5) table += '<tr>';
            }
            table += '</tbody></table>';
            $('#calendarTable').html(table);
        }

        function createScheduleReadonlyForm(data = {}) {
            console.log(data);

            let is_class_taken = data.is_class_taken;
            let scheduleId = data.id;

            // Button for Take Attendance
            let takeAttendanceBtn = '';
            if (is_class_taken == 1) {
                takeAttendanceBtn =
                `<button type="button" class="btn btn-sm btn-secondary" disabled>Already Taken</button>`;
            } else {
                takeAttendanceBtn = `<button type="submit" class="btn btn-sm btn-primary">Take Attendance</button>`;
            }

            // Button for View Attendance (only if class is taken)
            let viewAttendanceBtn = '';
            if (is_class_taken == 1 && scheduleId) {
                viewAttendanceBtn = `
            <a href="/teacher/${teacherId}/attendance/${scheduleId}" target="_blank" class="btn btn-sm btn-info ms-2">
                View Attendance
            </a>`;
            }

            return `
        <form action="{{ route('take-attedance') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="selected_date" value="${data.date || ''}">
            <div class="border p-3 mb-3 bg-light rounded">
                <div class="mb-2">
                    <label>Subject</label>
                    <input type="text" class="form-control" value="${data.subjectdtl?.subjectname || ''}" readonly>
                    <input type="hidden" class="form-control" name="subjectname" value="${data.subjectdtl?.id || ''}" readonly>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label>Class</label>
                        <input type="text" class="form-control" name="class_name" value="${data.classdtl?.classname || data.class_name || ''}" readonly>
                    </div>
                    <div class="col">
                        <label>Day</label>
                        <input type="text" class="form-control" name="day" value="${data.day || ''}" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label>Start Time</label>
                        <input type="text" class="form-control" name="start_time" value="${data.start_time || ''}" readonly>
                    </div>
                    <div class="col">
                        <label>End Time</label>
                        <input type="text" class="form-control" name="end_time" value="${data.end_time || ''}" readonly>
                    </div>
                </div>
                ${takeAttendanceBtn}
                ${viewAttendanceBtn}
            </div>
        </form>`;
        }



        $(document).ready(function() {
            renderCalendar(currentDate.getFullYear(), currentDate.getMonth());

            $('#prevMonth').click(function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
            });

            $('#nextMonth').click(function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
            });

            $(document).on('click', '.calendar-date', function() {
                const selectedDate = $(this).data('date');
                $.ajax({
                    url: `/teacher/${teacherId}/teacher_schedules/${selectedDate}`,
                    type: 'GET',
                    success: function(response) {
                        $('#scheduleWrapper').html('');
                        if (response.length > 0) {
                            response.forEach(schedule => {
                                schedule.date =
                                    selectedDate; // pass selected date into form
                                $('#scheduleWrapper').append(createScheduleReadonlyForm(
                                    schedule));
                            });
                        } else {
                            $('#scheduleWrapper').html(
                                '<p>No schedules found for this date.</p>');
                        }
                    },
                    error: function() {
                        $('#scheduleWrapper').html(
                            '<p class="text-danger">Error loading schedules.</p>');
                    }
                });
            });

            // Auto-select today
            const todayStr = new Date().toISOString().split('T')[0];
            setTimeout(() => {
                $(`.calendar-date[data-date="${todayStr}"]`).trigger('click');
            }, 100);
        });
    </script>
@endpush
