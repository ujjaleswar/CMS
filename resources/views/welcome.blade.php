<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .carousel-inner img {
            height: 520px;
            object-fit: cover;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.4);
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .carousel-caption h1 {
            font-size: 5rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 800;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.8);
        }
    </style>
</head>

<body>
    {{-- Header/Navbar --}}
    @if (Route::has('login'))
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/clglogo.png') }}" class="navbar-brand fs-6 mb-0 text-dark" alt="logo"
                        style="height: 60px;">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="{{ route('landingpage') }}">Home</a></li>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">About Us</a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item" href="#">Journey</a></li>
                                <li><a class="dropdown-item" href="#">Gallery</a></li>
                            </ul>
                        </li> --}}
                        <li class="nav-item"><a class="nav-link active" href="{{ route('landingpage') }}">About Us</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="achievementDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Achievement</a>
                            <ul class="dropdown-menu" aria-labelledby="achievementDropdown">
                                <li><a class="dropdown-item" href="#">Our Students' Achievements</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact.show') }}">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('create-students') }}">Apply for
                                Study</a></li>
                    </ul>

                    <div class="d-flex">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary me-2">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success me-2">Log in</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    @endif

    {{-- Carousel --}}
    <div id="collegeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/college1.jpg') }}" class="d-block w-100" alt="Banner 1">
                <div class="carousel-caption d-flex justify-content-center align-items-center">
                    <h1 class="text-white">CMSYS</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/college2.avif') }}" class="d-block w-100" alt="Banner 2">
                <div class="carousel-caption d-flex justify-content-center align-items-center">
                    <h1 class="text-white">CMSYS</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/college3.avif') }}" class="d-block w-100" alt="Banner 3">
                <div class="carousel-caption d-flex justify-content-center align-items-center">
                    <h1 class="text-white">CMSYS</h1>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#collegeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#collegeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- About Us --}}
    <section class="py-4 bg-light text-center">
        <div class="container">
            <h2 class="display-5 fw-bold mb-2">About Us</h2>
            <p class="lead mx-auto" style="max-width: 900px;">
                The College Management System (CMSYS) is a comprehensive platform designed to simplify and enhance the
                administration and academic management of colleges. It streamlines processes like student enrollment,
                attendance tracking, timetable scheduling, and performance evaluation, providing a seamless experience
                for students, teachers, and administrators alike.
            </p>
        </div>
    </section>

    {{-- News Section --}}
    <section class="py-4">
        <div class="container">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Latest News</h5>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;" id="newsContainer">
                    <p>Loading news...</p>
                </div>
            </div>
        </div>
    </section>

    {{-- News Script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('news.index') }}")
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('newsContainer');
                    container.innerHTML = '';
                    if (data.length === 0) {
                        container.innerHTML = '<p>No news available.</p>';
                    } else {
                        data.forEach(news => {
                            const newsItem = document.createElement('div');
                            newsItem.classList.add('mb-3');
                            newsItem.innerHTML = `
                                <h6>${news.title}</h6>
                                <p>${news.description}</p>
                                <hr>
                            `;
                            container.appendChild(newsItem);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching news:', error);
                    document.getElementById('newsContainer').innerHTML = '<p>Error loading news.</p>';
                });
        });
    </script>

    {{-- Locate Us Map Full Width --}}
    <section class="py-3 bg-light">
        <h2 class="fw-bold mb-4 text-center" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            Locate Us on Google Map</h2>
        <div style="width: 100%; height: 500px;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4648822996464!2d77.5946!3d12.9716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670a0c7b011%3A0xabcd1234567890!2sYour%20College%20Name!5e0!3m2!1sen!2sin!4v1624000000000!5m2!1sen!2sin"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="text-light pt-4 pb-2 " style="background-color: rgb(16, 112, 177);">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">College Management</h5>
                    <p>CMSYS is your all-in-one platform for managing academic and administrative tasks efficiently and
                        effortlessly.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="{{ route('contact.show') }}" class="text-white text-decoration-none">Contact
                                Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Achievements</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Contact</h5>
                    <p>Email: info@cmsyscollege.com</p>
                    <p>Phone: +91 98765 43210</p>
                    <p>Address: 123 College Road, City, State</p>
                </div>
            </div>

            <hr class="border-secondary">
            <div class="text-center">
                <small>&copy; {{ date('Y') }} College Management System. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
