@extends('layouts.app')

@section('content')
    <form class="p-4 border rounded bg-light mt-2" id="subjectForm" action="{{ route('store-subjects') }}" method="POST">
        @csrf
        <h4 class="mb-4">Create Subject</h4>

        <div class="mb-3">
            <label for="subjectName" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="subjectName" name="subject_name" />
            <div class="text-danger error-message"></div>
        </div>

        <div class="mb-3">
            <label for="subjectCode" class="form-label">Subject Code</label>
            <input type="text" class="form-control" id="subjectCode" name="subject_code" />
            <div class="text-danger error-message"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Applied For</label>
            <select name="applied_year" class="form-select">
                <option value="">Choose...</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class }}</option>
                @endforeach
            </select>
            <div class="text-danger error-message"></div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Subject</button>
    </form>

    {{-- jQuery Validation Script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#subjectForm').submit(function(e) {
            let isValid = true;

            // Clear previous errors
            $('.error-message').text('');
            $('.form-control, .form-select').removeClass('is-invalid');

            // Validate all required fields
            $(this).find('input[name="subject_name"], input[name="subject_code"], select[name="applied_year"]')
                .each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                        $(this).closest('.mb-3').find('.error-message').text('This field is required.');
                    }
                });

            if (!isValid) e.preventDefault();
        });
    </script>
@endsection
