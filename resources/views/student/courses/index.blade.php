@extends('layouts.student')

@section('title', 'Student Dashboard')
@section('page-title', 'Student Dashboard')

@section('content')

<div class="container-fluid">

    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>
            <h4 class="mb-1 fw-bold">
                <i class="bi bi-book me-2"></i>
                My Courses
            </h4>

            <p class="mb-0 text-muted">
                Courses assigned to you
            </p>
        </div>

        <span class="badge bg-dark fs-6">
            {{ $courses->total() }} Courses
        </span>

    </div>


    <div class="row g-4">

        @forelse($courses as $course)

            <div class="col-md-6 col-lg-4">

                <div class="overflow-hidden border-0 shadow-sm card h-100">

                    {{-- Course Image --}}

                    @if($course->image)

                        <img
                            src="{{ asset('uploads/courses/' . basename($course->image)) }}"
                            class="card-img-top"
                            style="height:200px; object-fit:cover;"
                            alt="{{ $course->name }}"
                        >

                    @else

                        <div
                            class="text-white bg-dark d-flex align-items-center justify-content-center"
                            style="height:200px;"
                        >
                            <i class="bi bi-book fs-1"></i>
                        </div>

                    @endif


                    <div class="card-body">

                        <span class="mb-2 badge bg-secondary">
                            {{ $course->category->name ?? 'Training' }}
                        </span>

                        <h5 class="fw-bold">
                            {{ $course->name }}
                        </h5>

                        <p class="text-muted small">
                            {{ Str::limit($course->description, 120) }}
                        </p>


                        <div class="mb-3 d-flex justify-content-between">

                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>
                                {{ $course->duration ?? 'N/A' }}
                            </small>

                            <small class="text-muted">
                                <i class="bi bi-laptop me-1"></i>
                                {{ ucfirst($course->training_mode) }}
                            </small>

                        </div>


                        <a
                            href="#"
                            class="btn btn-dark w-100"
                        >
                            <i class="bi bi-eye me-1"></i>
                            View Course
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="border-0 shadow-sm card">

                    <div class="py-5 text-center card-body">

                        <i class="bi bi-book fs-1 text-muted"></i>

                        <h5 class="mt-3">
                            No Courses Assigned
                        </h5>

                        <p class="mb-0 text-muted">
                            No course has been assigned to your account yet.
                        </p>

                    </div>

                </div>

            </div>

        @endforelse

    </div>


    <div class="mt-4">

        {{ $courses->links() }}

    </div>

</div>

@endsection
