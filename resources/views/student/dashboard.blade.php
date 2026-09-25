@extends('layouts.student')

@section('title', 'Student Dashboard')
@section('page-title', 'Student Dashboard')

@section('content')

    <!-- WELCOME -->

    <div class="mb-4 welcome-card">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    Welcome,
                    {{ $user->name }} 👋
                </h2>

                <p class="mb-0 text-light">

                    Continue your learning journey
                    and keep improving your skills.

                </p>

            </div>


            <div class="mt-3 col-md-4 text-md-end mt-md-0">

                <div class="fs-1">
                    🎓
                </div>

            </div>

        </div>

    </div>


    <!-- STAT CARDS -->

    <div class="mb-4 row g-4">


        <div class="col-md-4">

            <div class="stat-card">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="mb-1 text-muted">
                            My Courses
                        </p>

                        <h2 class="fw-bold">
                            {{ $courses->count() }}
                        </h2>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-book"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="stat-card">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="mb-1 text-muted">
                            My Batches
                        </p>

                        <h2 class="fw-bold">
                            {{ $batches->count() }}
                        </h2>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-collection"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="stat-card">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="mb-1 text-muted">
                            Certificates
                        </p>

                        <h2 class="fw-bold">
                            {{ $certificates->count() }}
                        </h2>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-award"></i>

                    </div>

                </div>

            </div>

        </div>


    </div>


    <!-- PROFILE -->

    <div class="row g-4">


        <div class="col-lg-4">

            <div class="course-card">

                <h5 class="mb-3 fw-bold">
                    My Profile
                </h5>

                <hr>

                <p>
                    <strong>Admission No:</strong><br>
                    {{ $student->admission_no }}
                </p>

                <p>
                    <strong>Email:</strong><br>
                    {{ $user->email }}
                </p>

                <p>
                    <strong>Phone:</strong><br>
                    {{ $student->phone ?? 'Not Available' }}
                </p>

                <p>
                    <strong>Qualification:</strong><br>
                    {{ $student->qualification ?? 'Not Available' }}
                </p>

            </div>

        </div>


        <!-- COURSES -->

        <div class="col-lg-8">

            <div class="course-card">

                <div class="mb-3 d-flex justify-content-between">

                    <h5 class="fw-bold">
                        My Courses
                    </h5>

                    <span class="badge bg-dark">
                        {{ $courses->count() }}
                    </span>

                </div>


                @forelse($courses as $course)

                    <div
                        class="py-3 d-flex align-items-center border-bottom"
                    >

                        <div class="course-icon me-3">

                            <i class="bi bi-book"></i>

                        </div>


                        <div>

                            <h6 class="mb-1">
                                {{ $course->name }}
                            </h6>

                            <small class="text-muted">

                                {{ ucfirst($course->training_mode) }}

                                @if($course->duration)
                                    • {{ $course->duration }}
                                @endif

                            </small>

                        </div>

                    </div>

                    <div class="mt-1 row g-4">

    <div class="col-12">

        <div class="course-card">

            <div class="mb-4 d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="mb-1 fw-bold">
                        <i class="bi bi-play-circle me-2"></i>
                        My Training Videos
                    </h5>

                    <small class="text-muted">
                        Videos from your enrolled courses
                    </small>
                </div>

                <span class="badge bg-dark">
                    {{ $videos->count() }} Videos
                </span>

            </div>


            <div class="row g-4">

                @forelse($videos as $video)

                    <div class="col-md-6 col-lg-4">

                        <div class="overflow-hidden border rounded-3 h-100">

                            {{-- Thumbnail --}}

                            @if(!empty($video->thumbnail))

                             <img
    src="{{ asset($video->thumbnail) }}"
    class="w-100"
    style="height:180px; object-fit:cover;"
    alt="{{ $video->title }}"
>
                            @else

                                <div
                                    class="text-white d-flex align-items-center justify-content-center bg-dark"
                                    style="height:180px;"
                                >

                                    <i class="bi bi-play-circle fs-1"></i>

                                </div>

                            @endif


                            <div class="p-3">

                                <h6 class="mb-2 fw-bold">
                                    {{ $video->title }}
                                </h6>


                                <small class="mb-3 text-muted d-block">

                                    <i class="bi bi-book me-1"></i>

                                    {{ $video->course->name ?? 'Course' }}

                                </small>


                                @if(!empty($video->description))

                                    <p class="text-muted small">

                                        {{ Str::limit($video->description, 100) }}

                                    </p>

                                @endif


                                <a
                                    href="{{ $video->video_url }}"
                                    target="_blank"
                                    class="btn btn-sm btn-dark w-100"
                                >

                                    <i class="bi bi-play-fill me-1"></i>

                                    Watch Video

                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="py-5 text-center">

                            <i
                                class="bi bi-camera-video-off fs-1 text-muted"
                            ></i>

                            <p class="mt-2 mb-0 text-muted">
                                No training videos available.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

                @empty

                    <div class="py-5 text-center">

                        <i
                            class="bi bi-book fs-1 text-muted"
                        ></i>

                        <p class="mt-2 text-muted">
                            No courses assigned yet.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

@endsection
