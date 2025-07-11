{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Multi-Step Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" /> --}}
@extends('layouts.app')

@section('content')
    <style>
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }
    </style>
    </head>

    <body>
        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4>Student Registration Form</h4>
                </div>
                <div class="card-body">
                    <form id="multiStepForm" action="{{ route('student-update', $student->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        @method('PUT')


                        <!-- Section A: Personal Details -->
                        <div class="form-step active">
                            <h5 class="mb-3">Section A: Personal Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="fullName" class="form-control"
                                    value="{{ old('fullName', $student->full_name ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $student->email ?? '') }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control"
                                    value="{{ old('phone', $student->phone ?? '') }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control"
                                    value="{{ old('dob', $student->dob ?? '') }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Male"
                                        id="genderMale"
                                        {{ old('gender', $student->gender ?? '') == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Female"
                                        id="genderFemale"
                                        {{ old('gender', $student->gender ?? '') == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Section B: Family & Address -->
                        <div class="form-step">
                            <h5 class="mb-3">Section B: Family & Address</h5>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control">{{ old('address', $student->address ?? '') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Father's Name</label>
                                <input type="text" name="fatherName" class="form-control"
                                    value="{{ old('fatherName', $student->father_name ?? '') }}"
                                    @if (!isset($student)) required @endif />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mother's Name</label>
                                <input type="text" name="motherName" class="form-control"
                                    value="{{ old('motherName', $student->mother_name ?? '') }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nationality</label>
                                <input type="text" name="nationality" class="form-control"
                                    value="{{ old('nationality', $student->nationality ?? '') }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Religion</label>
                                <input type="text" name="religion" class="form-control"
                                    value="{{ old('religion', $student->religion ?? '') }}" />
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Section C: Course & Documents -->
                        <div class="form-step">
                            <h5 class="mb-3">Section C: Course Details & Document Upload</h5>
                            <div class="mb-3">
                                <label class="form-label">Course Applying For</label>
                                <select name="course" class="form-select"
                                    @if (!isset($student)) required @endif>
                                    <option disabled {{ old('course', $student->course ?? '') == '' ? 'selected' : '' }}>
                                        Choose...</option>
                                    <option value="+2"
                                        {{ old('course', $student->course ?? '') == '+2' ? 'selected' : '' }}>+2</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Previous Qualification</label>
                                <input type="text" name="qualification" class="form-control"
                                    value="{{ old('qualification', $student->qualification ?? '') }}" />
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label">Asing role</label>
                                <select id="role" name="role"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" disabled selected>Select role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="mb-3">
                                <label class="form-label">Upload Passport Photo</label>
                                <input type="file" name="photo" class="form-control" />
                                @if ($student->photo_path)
                                    <img src="{{ asset($student->photo_path) }}" alt=" Image" style="height: 50px;">
                                @endif

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload ID Proof</label>
                                <input type="file" name="idProof" class="form-control" />
                                @if ($student->id_proof_path)
                                    <img src="{{ asset($student->id_proof_path) }}" alt=" Image"
                                        style="height: 50px;">
                                @endif
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Navigation Script -->
        <script>
            const steps = document.querySelectorAll(".form-step");
            const nextBtns = document.querySelectorAll(".next-step");
            const prevBtns = document.querySelectorAll(".prev-step");
            let currentStep = 0;

            nextBtns.forEach((btn) => {
                btn.addEventListener("click", () => {
                    if (currentStep < steps.length - 1) {
                        steps[currentStep].classList.remove("active");
                        currentStep++;
                        steps[currentStep].classList.add("active");
                    }
                });
            });

            prevBtns.forEach((btn) => {
                btn.addEventListener("click", () => {
                    if (currentStep > 0) {
                        steps[currentStep].classList.remove("active");
                        currentStep--;
                        steps[currentStep].classList.add("active");
                    }
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        {{-- </body>

    </html> --}}
    @endsection
