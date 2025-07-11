@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Create Teacher</h1>

        <form id="teacherForm" action="{{ route('store-teachers') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter full name">
                <div class="text-danger error-message"></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email address">
                <div class="text-danger error-message"></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="tel" class="form-control" name="phone" placeholder="Enter phone number">
                <div class="text-danger error-message"></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Role</label>
                <select name="role" class="form-select">
                    <option value="">Select role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <div class="text-danger error-message"></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Preferred Subject</label>
                <select class="form-select" name="teacherSubject[]" multiple>
                    <option disabled>Choose one or more subjects</option>
                    @foreach ($subjects as $sub)
                        <option value="{{ $sub->id }}">{{ $sub->subjectname }}</option>
                    @endforeach
                </select>
                <div class="text-danger error-message"></div>
            </div>

            <button type="submit" class="btn btn-primary">Create Teacher</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#teacherForm').submit(function(e) {
            let isValid = true;

            // Clear old errors
            $('.error-message').text('');
            $('input, select').removeClass('is-invalid');

            $(this).find('input[name="name"], input[name="email"], input[name="phone"], select[name="role"]').each(
                function() {
                    if (!$(this).val().trim()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                        $(this).closest('.mb-3').find('.error-message').text('This field is required.');
                    }
                });

            // Preferred Subject (must have at least one selected)
            const selectedSubjects = $('select[name="teacherSubject[]"]').val();
            if (!selectedSubjects || selectedSubjects.length === 0) {
                isValid = false;
                $('select[name="teacherSubject[]"]').addClass('is-invalid');
                $('select[name="teacherSubject[]"]').closest('.mb-3').find('.error-message').text(
                    'Please select at least one subject.');
            }

            if (!isValid) e.preventDefault();
        });
    </script>
@endsection
