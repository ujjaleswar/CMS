@extends('layouts.main')
@section('content')
    {{-- Carousel --}}
    <div id="collegeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/college1.jpg') }}" class="d-block w-100" alt="Banner 1">
                <div class="carousel-caption d-flex justify-content-center align-items-center">
                    <h1 class="text-white">CMS</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/college2.avif') }}" class="d-block w-100" alt="Banner 2">
                <div class="carousel-caption d-flex justify-content-center align-items-center">
                    <h1 class="text-white">CMS</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/college3.avif') }}" class="d-block w-100" alt="Banner 3">
                <div class="carousel-caption d-flex justify-content-center align-items-center">
                    <h1 class="text-white">CMS</h1>
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
                The College Management System (CMS) is a comprehensive platform designed to simplify and enhance the
                administration and academic management of colleges. It streamlines processes like student enrollment,
                attendance tracking, timetable scheduling, and performance evaluation, providing a seamless experience
                for students, teachers, and administrators alike.
            </p>
        </div>
    </section>

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
    <section class="py-4 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Latest News</h2>

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">News Feed</h5>
                </div>
                <div class="card-body overflow-hidden" style="height: 300px;">
                    <div class="news-scroll-wrapper">
                        <div class="news-scroll-content" id="newsContent">
                            <!-- News will be loaded here dynamically -->
                            <p>Loading news...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .news-scroll-wrapper {
            overflow: hidden;
            position: relative;
            height: 300px;
        }

        .news-scroll-content {
            display: inline-block;
            white-space: nowrap;
            animation: scrollUp 15s linear infinite;
        }

        @keyframes scrollUp {
            0% {
                transform: translateY(0%);
            }

            100% {
                transform: translateY(-50%);
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('news.index.json') }}")
                .then(response => response.json())
                .then(data => {
                    const content = document.getElementById('newsContent');
                    content.innerHTML = '';

                    if (data.length === 0) {
                        content.innerHTML = '<p class="text-center">No news available.</p>';
                        return;
                    }

                    let newsHtml = '';
                    data.forEach(news => {
                        newsHtml += `
                        <div class="mb-3 pb-2 border-bottom">
                            <h6 class="fw-bold text-primary">${news.title}</h6>
                            <p class="mb-1">${news.description}</p>
                            <small class="text-muted">Published: ${new Date(news.created_at).toLocaleDateString()}</small>
                        </div>
                    `;
                    });

                    // Duplicate news content for smooth scrolling loop
                    content.innerHTML = newsHtml + newsHtml;
                })
                .catch(error => {
                    console.error('Error fetching news:', error);
                    document.getElementById('newsContent').innerHTML =
                        '<p class="text-center text-danger">Error loading news.</p>';
                });
        });
    </script>



    {{-- Locate Us Map Full Width --}}
    <section class="py-3 bg-light">
        <h2 class="fw-bold mb-4 text-center" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            Locate Us on Google Map
        </h2>
        <div style="width: 100%; height: 500px;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3794.6001743721344!2d85.81806367474135!3d20.29605800699402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a1909d29061e90f%3A0x4b6a8f8822a02f7b!2sBhubaneswar%2C%20Odisha!5e0!3m2!1sen!2sin!4v1720172300000!5m2!1sen!2sin"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
@endsection
