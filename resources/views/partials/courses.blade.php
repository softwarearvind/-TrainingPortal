<!-- =====================================================
     COURSES
===================================================== -->

<section
    class="section-padding bg-light"
    id="courses"
>

    <div class="container">

        <div class="mb-5 section-title">

            <span>Popular Courses</span>

            <h2>
                Start Learning Today
            </h2>

            <p>
                Choose from our practical and career-focused
                training programs.
            </p>

        </div>


        <div class="row g-4">

            @forelse($homeCourses as $course)

                <div class="col-md-6 col-lg-4">

                    <div class="course-card">

                        @if($course->image)

                            <img
                                src="{{ asset('uploads/courses/' . basename($course->image)) }}"
                                class="course-image"
                                alt="{{ $course->name }}"
                            >

                        @else

                            <div
                                class="text-white course-image bg-dark d-flex align-items-center justify-content-center"
                            >
                                <i class="bi bi-book fs-1"></i>
                            </div>

                        @endif


                        <div class="course-body">

                            <span class="course-category">

                                {{ $course->category->name ?? 'Training' }}

                            </span>


                            <h5>
                                {{ $course->name }}
                            </h5>


                            <p>

                                {{ Str::limit(
                                    $course->description,
                                    100
                                ) }}

                            </p>


                            <div class="course-info">

                                <span class="text-muted">

                                    <i class="bi bi-clock me-1"></i>

                                    {{ $course->duration ?? 'Flexible' }}

                                </span>


                                <span class="course-price">

                                    ₹{{ number_format($course->fee, 0) }}

                                </span>

                            </div>


                            <a
                                href=""
                                class="mt-3 btn btn-dark w-100"
                            >

                                View Course

                                <i class="bi bi-arrow-right ms-1"></i>

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center col-12">

                    <p class="text-muted">
                        Courses will be available soon.
                    </p>

                </div>

            @endforelse

        </div>


        <div class="mt-5 text-center">

            <a
                href=""
                class="px-4 btn btn-enroll"
            >
                View All Courses
                <i class="bi bi-arrow-right ms-2"></i>
            </a>

        </div>

    </div>

</section>
