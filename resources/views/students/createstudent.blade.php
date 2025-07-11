@extends('layouts.main')

@section('content')
    <style>
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        body {
            background-color: rgb(245, 241, 241);
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 4px;
        }
    </style>

    <div class="container mt-3 mb-3">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Student Registration Form</h4>
            </div>
            <div class="card-body">
                <form id="multiStepForm" action="{{ route('store-students') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- SECTION A --}}
                    <div class="form-step active">
                        <h5 class="mb-3">Section A: Personal Details</h5>
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="fullName" class="form-control" required>
                            <div class="error-message"></div>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                            <div class="error-message"></div>
                        </div>
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="tel" name="phone" class="form-control" required>
                            <div class="error-message"></div>
                        </div>
                        <div class="mb-3">
                            <label>DOB</label>
                            <input type="date" name="dob" class="form-control" required>
                            <div class="error-message"></div>
                        </div>
                        <div class="mb-3">
                            <label>Gender</label><br>
                            <input type="radio" name="gender" value="Male" required> Male
                            <input type="radio" name="gender" value="Female"> Female
                            <div class="error-message"></div>
                        </div>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    {{-- SECTION B --}}
                    <div class="form-step">
                        <h5 class="mb-3">Section B: Family & Address</h5>
                        <div class="mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control" required></textarea>
                            <div class="error-message"></div>
                        </div>
                        <div class="mb-3">
                            <label>Father's Name</label>
                            <input type="text" name="fatherName" class="form-control" required>
                            <div class="error-message"></div>
                        </div>
                        <div class="mb-3">
                            <label>Mother's Name</label>
                            <input type="text" name="motherName" class="form-control" required>
                            <div class="error-message"></div>
                        </div>
                        <div class="mb-3">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control" required>
                            <div class="error-message"></div>
                        </div>
                        <div class="mb-3">
                            <label>Religion</label>
                            <input type="text" name="religion" class="form-control" required>
                            <div class="error-message"></div>
                        </div>
                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    {{-- SECTION C --}}
                    <div class="form-step">
                        <h5 class="mb-3">Section C: Course & Documents</h5>
                        <div class="mb-3">
                            <label>Course Applying For</label>
                            <select name="course" class="form-select" required>
                                <option value="">Choose...</option>
                                <option value="+2 Science">+2 Science</option>
                                <option value="+2 Arts">+2 Arts</option>
                            </select>
                            <div class="error-message"></div>
                        </div>

                        <div class="mb-3">
                            <label>Previous Qualification</label>
                            <select name="qualification" class="form-select" required>
                                <option value="">Choose...</option>
                                <option value="10th">10th</option>
                            </select>
                            <div class="error-message"></div>
                        </div>

                        <div class="mb-3">
                            <label>10th Percentage</label>
                            <input type="number" name="tenth_percentage" class="form-control" min="0" max="100"
                                required>
                            <div class="error-message"></div>
                        </div>

                        <div class="mb-3">
                            <label>Applied Year/Class</label>
                            <select name="applied_year" class="form-select" required>
                                <option value="">Choose...</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class }}</option>
                                @endforeach
                            </select>
                            <div class="error-message"></div>
                        </div>

                        <div class="mb-3">
                            <label>Upload Passport Photo</label>
                            <input type="file" name="photo" class="form-control" required>
                            <div class="error-message"></div>
                        </div>

                        <div class="mb-3">
                            <label>Upload ID Proof</label>
                            <input type="file" name="idProof" class="form-control" required>
                            <div class="error-message"></div>
                        </div>

                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const steps = $(".form-step");
        let currentStep = 0;

        function validateStep(step) {
            let isValid = true;

            $(steps[step]).find("input, select, textarea").each(function() {
                const $input = $(this);
                const type = $input.attr('type');
                const name = $input.attr('name');
                const value = $input.val();
                let error = "";

                if (type === 'radio') {
                    if ($('input[name="' + name + '"]:checked').length === 0) {
                        error = "Please select an option.";
                    }
                } else if ($input.is("select") && !value) {
                    error = "Please select an option.";
                } else if (type === 'file') {
                    if (this.files.length === 0) {
                        error = "This file is required.";
                    }
                } else if (!value) {
                    error = "This field is required.";
                }

                if (error) {
                    isValid = false;
                    $input.addClass('is-invalid');
                    $input.closest('.mb-3').find('.error-message').text(error);
                } else {
                    $input.removeClass('is-invalid');
                    $input.closest('.mb-3').find('.error-message').text('');
                }
            });

            return isValid;
        }

        $(".next-step").click(function() {
            if (validateStep(currentStep)) {
                $(steps[currentStep]).removeClass("active");
                currentStep++;
                $(steps[currentStep]).addClass("active");
            }
        });

        $(".prev-step").click(function() {
            $(steps[currentStep]).removeClass("active");
            currentStep--;
            $(steps[currentStep]).addClass("active");
        });

        $('input, select, textarea').on('input change', function() {
            $(this).removeClass('is-invalid');
            $(this).closest('.mb-3').find('.error-message').text('');
        });
    </script>
@endsection
