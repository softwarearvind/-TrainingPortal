@extends('layouts.student')

@section('title', 'Student Dashboard')
@section('page-title', 'Student Dashboard')

@section('content')
<div class="container-fluid">

    {{-- Header --}}

    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-1 fw-bold">
                <i class="bi bi-file-earmark-text me-2"></i>
                Study Materials
            </h4>

            <p class="mb-0 text-muted">
                Learning materials available for your courses
            </p>

        </div>

        <span class="badge bg-dark fs-6">
            {{ $materials->total() }} Materials
        </span>

    </div>


    {{-- Materials --}}

    <div class="row g-4">

        @forelse($materials as $material)

            <div class="col-md-6 col-lg-4">

                <div class="border-0 shadow-sm card h-100">

                    <div class="card-body">

                        {{-- Icon --}}

                        <div class="mb-3">

                            <div
                                class="d-flex align-items-center justify-content-center bg-light rounded-3"
                                style="width:60px;height:60px;"
                            >

                                <i class="bi bi-file-earmark-pdf fs-3 text-danger"></i>

                            </div>

                        </div>


                        {{-- Title --}}

                        <h5 class="mb-2 fw-bold">
                            {{ $material->title }}
                        </h5>


                        {{-- Course --}}

                        @if($material->course)

                            <div class="mb-2">

                                <small class="text-muted">
                                    <i class="bi bi-book me-1"></i>
                                    Course
                                </small>

                                <div class="fw-semibold">
                                    {{ $material->course->name }}
                                </div>

                            </div>

                        @endif


                        {{-- Batch --}}

                        @if($material->batch)

                            <div class="mb-2">

                                <small class="text-muted">
                                    <i class="bi bi-collection me-1"></i>
                                    Batch
                                </small>

                                <div class="fw-semibold">
                                    {{ $material->batch->name }}
                                </div>

                            </div>

                        @endif


                        {{-- Description --}}

                        @if($material->description)

                            <p class="mt-3 text-muted small">

                                {{ Str::limit(
                                    $material->description,
                                    120
                                ) }}

                            </p>

                        @endif


                        {{-- File --}}

                        @if($material->file)

                            <a
                                href="{{ asset('uploads/materials/' . basename($material->file)) }}"
                                target="_blank"
                                class="mt-3 btn btn-dark w-100"
                            >

                                <i class="bi bi-download me-2"></i>

                                Download Material

                            </a>

                        @else

                            <button
                                type="button"
                                class="mt-3 btn btn-secondary w-100"
                                disabled
                            >

                                File Not Available

                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="border-0 shadow-sm card">

                    <div class="py-5 text-center card-body">

                        <i class="bi bi-file-earmark-x fs-1 text-muted"></i>

                        <h5 class="mt-3">
                            No Study Materials
                        </h5>

                        <p class="mb-0 text-muted">
                            No study materials are currently available.
                        </p>

                    </div>

                </div>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}

    <div class="mt-4">

        {{ $materials->links() }}

    </div>

</div>


@endsection
