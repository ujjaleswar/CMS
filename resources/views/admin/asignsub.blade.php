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
                        <h5 class="mb-0">Assign Schedule</h5>
                    </div>
                    <div class="card-body">
                        <form id="scheduleForm" action="{{ route('schedule.store', $teacher->id) }}" method="POST">
                            @csrf
                            <input type="hidden" id="selected_date">
                            <div id="scheduleWrapper"></div>
                            <button type="button" class="btn btn-sm btn-secondary mb-2" id="addMoreSchedule">+ Add
                                More</button>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-sm btn-success">Assign</button>
                            </div>
                        </form>
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
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                "October", "November", "December"
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

        function createScheduleFormBlock(data = {}, dayName = '') {
            const selectedDay = data.day || dayName;
            return `<div class="schedule-entry border p-2 mb-3 position-relative">
                <input type="hidden" name="date[]" value="${data.date || $('#selected_date').val()}">
                <input type="hidden" name="schedule_id[]" value="${data.id || ''}">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-schedule"></button>
                <div class="mb-2">
                    <label>Subject</label>
                    <select class="form-select" name="teacherSubject[]" required>
                        <option disabled selected>Choose one</option>
                        @foreach ($subjects as $sub)
                            <option value="{{ $sub->id }}" ${data.subject == {{ $sub->id }} ? 'selected' : ''}>{{ $sub->subjectname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Class</label>
                    <select name="class_name[]" class="form-control form-control-sm">
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" ${data.class_name == '{{ $class->id }}' ? 'selected' : ''}>{{ $class->class }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label>Day</label>
                        <select name="day[]" class="form-select form-select-sm">
                            ${['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
                                .map(day => `<option ${selectedDay == day ? 'selected' : ''}>${day}</option>`).join('')}
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label>Start Time</label>
                        <input type="time" name="start_time[]" class="form-control form-control-sm" value="${data.start_time || ''}" required>
                    </div>
                    <div class="col">
                        <label>End Time</label>
                        <input type="time" name="end_time[]" class="form-control form-control-sm" value="${data.end_time || ''}" required>
                    </div>
                </div>
            </div>`;
        }

        $(document).ready(function() {
            renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
            const todayStr = new Date().toISOString().split('T')[0];
            $('#selected_date').val(todayStr);

            setTimeout(() => {
                $(`.calendar-date[data-date="${todayStr}"]`).trigger('click');
            }, 100);

            $('#prevMonth').click(() => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
            });

            $('#nextMonth').click(() => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
            });

            $(document).on('click', '.calendar-date', function() {
                const selectedDate = $(this).data('date');
                $('#selected_date').val(selectedDate);
                const dayName = new Date(selectedDate).toLocaleDateString('en-US', {
                    weekday: 'long'
                });

                $.get(`/teacher/${teacherId}/teacher_schedules/${selectedDate}`, function(response) {
                    $('#scheduleWrapper').html('');
                    if (response.length > 0) {
                        response.forEach(schedule => {
                            $('#scheduleWrapper').append(createScheduleFormBlock(schedule,
                                dayName));
                        });
                    } else {
                        $('#scheduleWrapper').append(createScheduleFormBlock({}, dayName));
                    }
                });
            });

            $('#addMoreSchedule').click(() => {
                const selectedDate = $('#selected_date').val();
                const dayName = new Date(selectedDate).toLocaleDateString('en-US', {
                    weekday: 'long'
                });
                $('#scheduleWrapper').append(createScheduleFormBlock({}, dayName));
            });

            $('#scheduleWrapper').on('click', '.remove-schedule', function() {
                $(this).closest('.schedule-entry').remove();
            });
        });
    </script>
@endpush
