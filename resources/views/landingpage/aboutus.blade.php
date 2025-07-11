@extends('layouts.main')

@section('content')
    <!-- Banner Section -->
    <section class="breadcrumb_area breadcrumb_overlay"
        data-background="https://atutbandhan.in/assets/frontend/img/Inner1.jpg"
        style="background-size: cover; background-color: rgb(30, 136, 229);">
        <div class="container text-center text-white py-5">
            <h1 class="display-4 fw-bold">About Our College</h1>
            <p class="lead">Excellence in Education, Innovation, and Leadership</p>
        </div>
    </section>

    <style>
        .about-section {
            padding: 60px 0;
        }

        .about-text {
            font-size: 20px;
            line-height: 1.8;
            color: #555;
        }

        .about-heading {
            font-size: 38px;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 20px;
        }

        .feature-icon {
            font-size: 48px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .large-img {
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-card {
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: 100%;
        }

        .fixed-img {
            width: 100%;
            height: 250px;
            /* Set desired height */
            object-fit: cover;
            /* Ensures image covers area without distortion */
            border-radius: 8px;
            /* Optional: adds rounded corners */
        }
    </style>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc" alt="College Campus"
                        class="img-fluid large-img">
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <h2 class="about-heading">Welcome to GVJC College</h2>
                    <p class="about-text">
                        GVJC College has been a beacon of educational excellence since its founding in 1998. Located in the
                        heart of Bhubaneswar, our institution fosters an environment where creativity meets academic rigor.
                        Over the decades, we have empowered thousands of students to shape their future through quality
                        education and ethical values.
                    </p>
                    <p class="about-text">
                        Our curriculum integrates traditional learning with modern technology, ensuring students are ready
                        for global challenges. Beyond academics, our students shine in sports, debates, cultural festivals,
                        and social outreach programs.
                    </p>
                </div>
            </div>

            <!-- Vision & Mission -->
            <div class="row mb-5">
                <div class="col-lg-6">
                    <h2 class="about-heading">Our Vision</h2>
                    <p class="about-text">
                        To create a vibrant community of lifelong learners driven by innovation, social responsibility, and
                        global citizenship.
                    </p>
                </div>
                <div class="col-lg-6">
                    <h2 class="about-heading">Our Mission</h2>
                    <p class="about-text">
                        ● Deliver holistic education that nurtures critical thinking and leadership. <br>
                        ● Empower students with cutting-edge skills for real-world success. <br>
                        ● Foster a supportive, inclusive, and ethical environment for all stakeholders.
                    </p>
                </div>
            </div>

            <!-- Features -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-book-reader feature-icon"></i>
                        <h4>Quality Education</h4>
                        <p>Interactive learning environments that inspire creativity and innovation.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-laptop feature-icon"></i>
                        <h4>Modern Facilities</h4>
                        <p>State-of-the-art labs, smart classrooms, and fully digitized libraries.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-users feature-icon"></i>
                        <h4>Experienced Faculty</h4>
                        <p>Faculty members who are subject matter experts and industry leaders.</p>
                    </div>
                </div>
            </div>

            <!-- Principal’s Message -->
            <div class="row mb-5">
                <div class="col-lg-12">
                    <h2 class="about-heading text-center mb-4">Principal's Message</h2>
                    <p class="about-text text-center">
                        "At GVJC College, we do not merely impart education, we shape futures. Our vision is to cultivate
                        curious minds, confident leaders, and responsible citizens. Together, let's build a better tomorrow
                        through compassion, learning, and innovation."
                    </p>
                    <p class="text-center fw-bold">— Dr. A. K. Sahoo, Principal</p>
                </div>
            </div>

            <!-- Achievements -->
            <div class="row mb-5">
                <div class="col-lg-12">
                    <h2 class="about-heading text-center mb-4">Our Achievements</h2>
                    <ul class="about-text">
                        <li>Accredited with an 'A' grade by the Education Council of India.</li>
                        <li>Over 100+ university rank holders in the last 5 years.</li>
                        <li>Winner of multiple state-level inter-college competitions.</li>
                        <li>Successful placement record in MNCs, banks, and government sectors.</li>
                        <li>Partnerships with global institutions for student exchange programs.</li>
                    </ul>
                </div>
            </div>

            <!-- Gallery -->
            <div class="row g-4">
                <h2 class="about-heading text-center mb-5">Campus Life in Pictures</h2>

                <div class="col-md-4">
                    <img src="{{ asset('images/laibary.avif') }}" alt="Library" class="img-fluid fixed-img">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/campus.webp') }}" alt="Campus Building" class="img-fluid fixed-img">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/sports.webp') }}" alt="Sports Event" class="img-fluid fixed-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS + FontAwesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
