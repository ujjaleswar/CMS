@extends('layouts.main')

@section('content')
    <!-- Banner -->
    <section class="breadcrumb_area breadcrumb_overlay"
        style="background-image: url('{{ asset('images/col.jpg') }}'); height: 400px; background-size: cover;">
        <div class="container text-center text-white py-3 ">
            <h1 class="display-4 fw-bold mt-7">Our Achievements</h1>
            <p class="lead">Celebrating Excellence, Passion, and Student Success Stories</p>
        </div>
    </section>

    <style>
        .achievements-section {
            padding: 60px 0;
        }

        .section-title {
            font-size: 40px;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 30px;
        }

        .achievement-text {
            font-size: 18px;
            line-height: 1.9;
            color: #555;
            margin-bottom: 20px;
        }

        .achievement-img {
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .highlight-card {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .highlight-card h4 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .highlight-icon {
            font-size: 50px;
            color: #0d6efd;
            margin-bottom: 10px;
        }
    </style>

    <!-- Achievements Section -->
    <section class="achievements-section">
        <div class="container">

            <!-- Introduction -->
            <div class="row mb-5">
                <div class="col-lg-12">
                    <h2 class="section-title text-center ">Proud Moments of GVJC College</h2>
                    <p class="achievement-text">
                        GVJC College has a proud legacy of nurturing talent and creating pathways for success. Over the
                        years, our students have consistently achieved academic brilliance, sports victories, and community
                        leadership. We celebrate these moments of excellence as a reflection of our faculty's dedication,
                        our students' hard work, and our vision of empowering future leaders.
                    </p>
                    <p class="achievement-text">
                        From winning university-level gold medals to representing our state in national championships, our
                        students have made us proud across diverse fields. Behind every success story is our commitment to
                        excellence, strong mentorship, and a vibrant campus environment that encourages holistic
                        development.
                    </p>
                </div>
            </div>

            <!-- Student Success Stories -->
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc" alt="Success Story"
                        class="img-fluid achievement-img">
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <h2 class="section-title">Inspiring Student Journeys</h2>
                    <p class="achievement-text">
                        Meet our alumni who have made their mark globally. Whether it’s tech startups in Bengaluru, NGOs in
                        Delhi, or Fortune 500 companies abroad, our graduates continue to excel in their respective fields.
                    </p>
                    <p class="achievement-text">
                        Our toppers have received scholarships to top universities and our athletes have brought home
                        numerous awards. Each student’s journey is a testament to their resilience and the opportunities
                        offered at GVJC College.
                    </p>
                </div>
            </div>

            <!-- Highlights -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="highlight-card text-center">
                        <i class="fas fa-trophy highlight-icon"></i>
                        <h4>120+ Awards</h4>
                        <p>Our students have won awards in academics, cultural activities, and sports at national and state
                            levels.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-card text-center">
                        <i class="fas fa-user-graduate highlight-icon"></i>
                        <h4>5000+ Graduates</h4>
                        <p>Thousands of alumni are leading successful careers in education, corporate sectors, and public
                            services.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-card text-center">
                        <i class="fas fa-globe highlight-icon"></i>
                        <h4>Global Impact</h4>
                        <p>Our alumni network spans across 10+ countries, contributing to international research, business,
                            and development.</p>
                    </div>
                </div>
            </div>

            <!-- More Stories -->
            <div class="row align-items-center mb-5">
                <div class="col-md-6 order-md-2">
                    <img src="{{ asset('images/toperstudent.jpg') }}" alt="Achievement Ceremony"
                        class="img-fluid achievement-img">
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <h2 class="section-title">Beyond the Classroom</h2>
                    <p class="achievement-text">
                        Our vision goes beyond academics. Students at GVJC College actively participate in community
                        outreach, environmental sustainability drives, and leadership summits. Their compassion and
                        commitment have brought positive change to society.
                    </p>
                    <p class="achievement-text">
                        Annual events like TechFest, Sports Week, and Cultural Carnival give students the platform to
                        showcase their talents and learn teamwork, leadership, and creativity.
                    </p>
                </div>
            </div>

            <!-- Closing Note -->
            <div class="row">
                <div class="col-lg-12">
                    <p class="achievement-text text-center">
                        We believe every student is capable of greatness. Through guidance, opportunity, and encouragement,
                        we will continue to create leaders who shape a better tomorrow.
                    </p>
                    <h3 class="text-center text-primary fw-bold mt-4">"The future belongs to those who believe in the beauty
                        of their dreams."</h3>
                </div>
            </div>

        </div>
    </section>

    <!-- Bootstrap JS + FontAwesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
