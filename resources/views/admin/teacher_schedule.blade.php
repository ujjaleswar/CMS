@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="mb-2">Schedules for {{ $teacher->name }}</h1>
        <a href="{{ route('asign', $teacher->id) }}" class="btn btn-warning mt-3 mb-1">Back</a>

        @if ($schedules->isEmpty())
            <div class="alert alert-info">No schedules assigned yet.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Class</th>

                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') }}</td>
                            <td>{{ $schedule->day }}</td>
                            <td>{{ $schedule->class_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
