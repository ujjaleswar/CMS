<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div>
            {{-- <h5 class="text-primary fw-bold mb-4">Admin panel</h5> --}}
            <ul class="nav nav-pills flex-column gap-4">
                @role('admin')
                    <h5 class="text-primary fw-bold mb-4">Admin panel</h5>
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center rounded" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-3"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded" href="{{ route('subjects-index') }}">
                            <i class="bi bi-journal-bookmark me-3"></i> Subjects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded" href="{{ route('class-listing') }}">
                            <i class="bi bi-journal-bookmark me-3"></i> Class
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded" href="{{ route('student-list') }}">
                            <i class="bi bi-people me-3"></i> Student
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded"
                            href="{{ route('attendance.list') }}">
                            <i class="bi bi-journal-bookmark me-3"></i> Shortlisted Student
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded"
                            href="{{ route('teachers-index') }}">
                            <i class="bi bi-person-badge me-3"></i> Teacher
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded"
                            href="{{ route('student-attendace-cheack') }}" aria-controls="teacherProfile">
                            <i class="bi bi-person-badge me-3"></i> Students Attendace list
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded" href="{{ route('blogs.index') }}"
                            aria-controls="teacherProfile">
                            <i class="bi bi-person-badge me-3"></i> Upadte News
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded" href="{{ route('contact.index') }}"
                            aria-controls="teacherProfile">
                            <i class="bi bi-person-badge me-3"></i> Feedback
                        </a>
                    </li>
                @endrole
                {{-- @hasanyrole(['teacher', 'admin']) --}}
                @role('teacher')
                    <h5 class="text-primary fw-bold mb-4">Teacher panel</h5>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded"
                            href="{{ route('teacher-details', Auth::user()->id) }}" aria-controls="teacherProfile">
                            <i class="bi bi-person-badge me-3"></i> Teachers details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded"
                            href="{{ route('teacher_shedulelist', Auth::user()->id) }}" aria-controls="teacherProfile">
                            <i class="bi bi-person-badge me-3"></i> Teachers Shedule
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded"
                            href="{{ route('student-attendace-cheack') }}" aria-controls="teacherProfile">
                            <i class="bi bi-person-badge me-3"></i> Students Attendace list
                        </a>
                    </li> --}}
                @endrole
                {{-- @endhasanyrole --}}
                @role('student')
                    <h5 class="text-primary fw-bold mb-4">Student panel</h5>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded"
                            href="{{ route('student-information', Auth::user()->id) }}">
                            <i class="bi bi-people me-3"></i> Student inforamtion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark rounded"
                            href="{{ route('check-attendance') }}">
                            <i class="bi bi-people me-3"></i> Check attendance
                        </a>
                    </li>
                @endrole
            </ul>
        </div>
    </div>
</div>
