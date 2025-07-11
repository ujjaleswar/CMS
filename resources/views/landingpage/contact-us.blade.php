@extends('layouts.main')

@section('content')
    <section class="breadcrumb_area breadcrumb_overlay py-2 mt-4"
        data-background="https://atutbandhan.in//assets/frontend/img/Inner1.jpg"
        style="background-size: cover; background-color: rgb(133, 198, 252)">
        <div class="container py-3">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb_section">
                        <div class="breadcrumb_title">
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .contact-section {
            background-color: #fff;
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .info-box {
            background-color: #f8f9fc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        .info-box i {
            font-size: 26px;
            color: #0d6efd;
            flex-shrink: 0;
            margin-top: 3px;
        }

        .info-box h6 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-control,
        .btn-primary {
            border-radius: 8px;
        }

        .btn-primary {
            padding: 12px 25px;
            font-size: 16px;
        }

        .text-primary {
            color: #0d6efd !important;
        }
    </style>

    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 contact-section">
                <div class="row g-4 align-items-start">

                    <!-- Contact Form -->
                    <div class="col-md-7">
                        <h3 class="mb-4 text-primary">Send Us a Message</h3>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.submit') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Your Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Your Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label fw-semibold">Your Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5"
                                    placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-md-5">
                        <h4 class="mb-4 text-primary">Get In Touch</h4>

                        <div class="info-box">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h6>Location</h6>
                                <p class="mb-0">GVJC College,<br>Bhubaneswar, 751005</p>
                            </div>
                        </div>

                        <div class="info-box">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h6>Email</h6>
                                <p class="mb-0">
                                    <a href="mailto:ujjaleswar@gmail.com" class="text-decoration-none text-dark">
                                        ujjaleswar@gmail.com
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="info-box">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h6>Phone</h6>
                                <p class="mb-0">
                                    <a href="tel:682646643" class="text-decoration-none text-dark">
                                        682646643
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
