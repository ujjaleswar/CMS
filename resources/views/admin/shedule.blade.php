{{-- @extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow" style="max-width: 400px; margin: 0 auto;">
            <div class="card-header bg-info text-white text-center">
                <h5>Assign Schedule to {{ $teacher->name }}</h5>
            </div>
            <div class="card-body p-3" style="height: 450px; overflow: auto;">
                <div id="calendar" style="height: 100%;"></div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '100%',
                dateClick: function(info) {
                    const selectedDate = info.dateStr;
                    const teacherId = "{{ $teacher->id }}";
                    window.location.href = `/view/asignsub/${teacherId}/${selectedDate}`;

                }
            });
            calendar.render();
        });
    </script>
@endpush --}}
