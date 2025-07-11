@extends('layouts.app')

@section('content')
    <form class="p-4 border rounded bg-light mt-2" action="{{ route('subjectupdate', $subjects->id) }}" method="POST">
        @csrf
        @method('put')

        <h4 class="mb-4">Update Subject</h4>

        <div class="mb-3">
            <label for="subjectName" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="subjectName" name="subject_name"
                value="{{ old('subject_name', $subjects->subjectname) }}" required />
        </div>

        <div class="mb-3">
            <label for="subjectCode" class="form-label">Subject Code</label>
            <input type="text" class="form-control" id="subjectCode" name="subject_code"
                value="{{ old('subject_code', $subjects->subjectcode) }}" required />
        </div>

        <div class="mb-3">
            <label for="appliedYear" class="form-label">Applied Year</label>
            <select name="applied_year" class="form-select" required>
                <option disabled selected>Choose...</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ old('applied_year', $subjects->year_course) == $class->id ? 'selected' : '' }}>
                        {{ $class->class }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $subjects->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Subject</button>
    </form>
@endsection
