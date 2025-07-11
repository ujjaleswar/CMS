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


    {{-- Carousel --}}
    {{-- <div id="collegeCarousel" class="carousel slide" data-bs-ride="carousel">
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
    </div> --}}

    {{-- About Us --}}
    {{-- <section class="py-4 bg-light text-center">
        <div class="container">
            <h2 class="display-5 fw-bold mb-2">About Us</h2>
            <p class="lead mx-auto" style="max-width: 900px;">
                The College Management System (CMSYS) is a comprehensive platform designed to simplify and enhance the
                administration and academic management of colleges. It streamlines processes like student enrollment,
                attendance tracking, timetable scheduling, and performance evaluation, providing a seamless experience
                for students, teachers, and administrators alike.
            </p>
        </div>
    </section> --}}

    {{-- News Section --}}
    {{-- <section class="py-4">
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
    </section> --}}

    {{-- News Script --}}
    {{-- <script>
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
    </script> --}}

    {{-- Locate Us Map Full Width --}}
    {{-- <section class="py-3 bg-light">
        <h2 class="fw-bold mb-4 text-center" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            Locate Us on Google Map</h2>
        <div style="width: 100%; height: 500px;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4648822996464!2d77.5946!3d12.9716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670a0c7b011%3A0xabcd1234567890!2sYour%20College%20Name!5e0!3m2!1sen!2sin!4v1624000000000!5m2!1sen!2sin"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section> --}}

    @include('layouts.header')
    @yield('content')
    @include('layouts.outerfooter')



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
