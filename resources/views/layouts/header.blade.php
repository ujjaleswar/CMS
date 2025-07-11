{{-- Header/Navbar --}}
@if (Route::has('login'))
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            {{-- <a href="{{ route('dashboard') }}"> --}}
            <img src="{{ asset('images/clglogo.png') }}" class="navbar-brand fs-6 mb-0 text-dark" alt="logo"
                style="height: 60px;">
            {{-- </a> --}}

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li class="nav-item"><a class="nav-link " href="{{ route('about-us') }}">About Us</a>
                    </li>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="achievementDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Achievement</a>
                        <ul class="dropdown-menu" aria-labelledby="achievementDropdown">
                            <li><a class="dropdown-item" href="#">Our Students' Achievements</a></li>
                        </ul>
                    </li> --}}
                    <li class="nav-item"><a class="nav-link " href="{{ route('achivement') }}">Achievement</a>
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
