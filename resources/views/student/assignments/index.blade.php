@extends('layouts.student')

@section('title', 'Student Dashboard')
@section('page-title', 'Student Dashboard')

@section('content')
<div class="container-fluid">

    {{-- Header --}}

    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-1 fw-bold">
                <i class="bi bi-clipboard-check me-2"></i>
                My Assignments
            </h4>

            <p class="mb-0 text-muted">
                Assignments from your courses and batches
            </p>

        </div>

        <span class="badge bg-dark fs-6">
            {{ $assignments->total() }} Assignments
        </span>

    </div>


    {{-- Assignment List --}}

    <div class="row g-4">

        @forelse($assignments as $assignment)

            <div class="col-md-6 col-xl-4">

                <div class="border-0 shadow-sm card h-100">

                    <div class="card-body">

                        {{-- Status --}}

                        <div class="mb-3 d-flex justify-content-between align-items-start">

                            <span class="badge bg-success">
                                Published
                            </span>

                            @if($assignment->due_date)

                                @if($assignment->due_date->isPast())

                                    <span class="badge bg-danger">
                                        Due Date Passed
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Active
                                    </span>

                                @endif

                            @endif

                        </div>


                        {{-- Title --}}

                        <h5 class="mb-3 fw-bold">
                            {{ $assignment->title }}
                        </h5>


                        {{-- Course --}}

                        <div class="mb-2">

                            <small class="text-muted">
                                <i class="bi bi-book me-1"></i>
                                Course
                            </small>

                            <div class="fw-semibold">
                                {{ $assignment->course->name ?? 'N/A' }}
                            </div>

                        </div>


                        {{-- Batch --}}

                        <div class="mb-2">

                            <small class="text-muted">
                                <i class="bi bi-collection me-1"></i>
                                Batch
                            </small>

                            <div class="fw-semibold">
                                {{ $assignment->batch->name ?? 'N/A' }}
                            </div>

                        </div>


                        {{-- Description --}}

                        @if($assignment->description)

                            <p class="mt-3 text-muted small">

                                {{ Str::limit(
                                    $assignment->description,
                                    120
                                ) }}

                            </p>

                        @endif


                        {{-- Marks --}}

                        <div class="mt-3 d-flex justify-content-between">

                            <div>

                                <small class="text-muted d-block">
                                    Total Marks
                                </small>

                                <strong>
                                    {{ $assignment->total_marks }}
                                </strong>

                            </div>


                            <div class="text-end">

                                <small class="text-muted d-block">
                                    Due Date
                                </small>

                                <strong>

                                    @if($assignment->due_date)

                                        {{ $assignment->due_date->format('d M Y h:i A') }}

                                    @else

                                        No Due Date

                                    @endif

                                </strong>

                            </div>

                        </div>


                        {{-- Attachment --}}

                        @if($assignment->attachment)

                            <a
                                href="{{ asset('uploads/assignments/' . basename($assignment->attachment)) }}"
                                target="_blank"
                                class="mt-3 btn btn-outline-secondary w-100"
                            >

                                <i class="bi bi-download me-1"></i>

                                Download Assignment

                            </a>

                        @endif


                        {{-- Submit --}}

                        <a
                            href="#"
                            class="mt-2 btn btn-dark w-100"
                        >

                            <i class="bi bi-upload me-1"></i>

                            Submit Assignment

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="border-0 shadow-sm card">

                    <div class="py-5 text-center card-body">

                        <i class="bi bi-clipboard-x fs-1 text-muted"></i>

                        <h5 class="mt-3">
                            No Assignments Found
                        </h5>

                        <p class="mb-0 text-muted">
                            No published assignments are available for you.
                        </p>

                    </div>

                </div>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}

    <div class="mt-4">

        {{ $assignments->links() }}

    </div>

</div>


@endsection
