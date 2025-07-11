@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Teacher</h1>

        <form action="{{ route('teachers-update', $teachers->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="teacherName" class="form-label">Name</label>
                <input type="text" class="form-control" id="teacherName" placeholder="Enter full name" name="name"
                    value="{{ old('name', $teachers->name) }}">
            </div>

            <div class="mb-3">
                <label for="teacherEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="teacherEmail" placeholder="Enter email address"
                    name="email" value="{{ old('email', $teachers->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="teacherPhone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="teacherPhone" placeholder="Enter phone number" name="phone"
                    value="{{ old('phone', $teachers->phone) }}" required>
            </div>

            <div class="mb-3">
                <label for="teacherSubject" class="form-label">Preferred Subject</label>
                <select class="form-select" name="teacherSubject[]" multiple required>
                    <option disabled>Choose one or more subjects</option>
                    @foreach ($subjects as $sub)
                        <option value="{{ $sub->id }}" @if (in_array($sub->id, old('teacherSubject', $teacherSubjects ?? []))) selected @endif>
                            {{ $sub->subjectname }}
                        </option>
                    @endforeach
                </select>

            </div>

            <button type="submit" class="btn btn-primary">Update Teacher</button>
        </form>
    </div>
@endsection
