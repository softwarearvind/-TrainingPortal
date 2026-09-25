@extends('layouts.student')

@section('title', 'Student Dashboard')
@section('page-title', 'Student Dashboard')

@section('content')

<div class="container-fluid">

    {{-- Header --}}

    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>
            <h4 class="mb-1 fw-bold">
                <i class="bi bi-collection me-2"></i>
                My Batches
            </h4>

            <p class="mb-0 text-muted">
                Your enrolled training batches
            </p>
        </div>

        <span class="badge bg-dark fs-6">
            {{ $batches->total() }} Batches
        </span>

    </div>


    {{-- Batches --}}

    <div class="row g-4">

        @forelse($batches as $batch)

            <div class="col-md-6 col-xl-4">

                <div class="border-0 shadow-sm card h-100">

                    <div class="card-body">

                        {{-- Batch Header --}}

                        <div class="mb-3 d-flex justify-content-between align-items-start">

                            <div>

                                <h5 class="mb-1 fw-bold">
                                    {{ $batch->name }}
                                </h5>

                                <small class="text-muted">
                                    Batch Code:
                                    {{ $batch->batch_code }}
                                </small>

                            </div>

                            <span class="badge
                                @if($batch->status === 'active')
                                    bg-success
                                @elseif($batch->status === 'completed')
                                    bg-primary
                                @else
                                    bg-secondary
                                @endif
                            ">
                                {{ ucfirst($batch->status) }}
                            </span>

                        </div>


                        <hr>


                        {{-- Course --}}

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                <i class="bi bi-book me-1"></i>
                                Course
                            </small>

                            <strong>
                                {{ $batch->course->name ?? 'N/A' }}
                            </strong>

                        </div>


                        {{-- Trainer --}}

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                <i class="bi bi-person-badge me-1"></i>
                                Trainer
                            </small>

                            <strong>
                                {{ $batch->trainer->name ?? 'Not Assigned' }}
                            </strong>

                        </div>


                        {{-- Training Mode --}}

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                <i class="bi bi-laptop me-1"></i>
                                Training Mode
                            </small>

                            <strong>
                                {{ ucfirst($batch->training_mode ?? 'N/A') }}
                            </strong>

                        </div>


                        {{-- Dates --}}

                        <div class="mb-3 row">

                            <div class="col-6">

                                <small class="text-muted d-block">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    Start Date
                                </small>

                                <strong>
                                    {{ $batch->start_date
                                        ? $batch->start_date->format('d M Y')
                                        : 'N/A'
                                    }}
                                </strong>

                            </div>

                            <div class="col-6">

                                <small class="text-muted d-block">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    End Date
                                </small>

                                <strong>
                                    {{ $batch->end_date
                                        ? $batch->end_date->format('d M Y')
                                        : 'N/A'
                                    }}
                                </strong>

                            </div>

                        </div>


                        {{-- Schedule --}}

                        @if(!empty($batch->schedule))

                            <div class="mb-3">

                                <small class="text-muted d-block">
                                    <i class="bi bi-clock me-1"></i>
                                    Schedule
                                </small>

                                <strong>
                                    {{ $batch->schedule }}
                                </strong>

                            </div>

                        @endif


                        {{-- Room / Location --}}

                        @if(!empty($batch->room) || !empty($batch->location))

                            <div class="mb-3">

                                <small class="text-muted d-block">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    Location
                                </small>

                                <strong>
                                    {{ $batch->room }}

                                    @if($batch->room && $batch->location)
                                        -
                                    @endif

                                    {{ $batch->location }}
                                </strong>

                            </div>

                        @endif


                        {{-- Google Meet --}}

                        @if(!empty($batch->meeting_link))

                            <div class="mt-4">

                                <a
                                    href="{{ $batch->meeting_link }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-success w-100"
                                >
                                    <i class="bi bi-camera-video-fill me-2"></i>
                                    Join Google Meet
                                </a>

                            </div>

                        @elseif(
                            isset($batch->training_mode)
                            && in_array(
                                $batch->training_mode,
                                ['online', 'hybrid']
                            )
                        )

                            <div class="mt-3 mb-0 alert alert-warning">

                                <i class="bi bi-exclamation-circle me-1"></i>

                                Online meeting link is not available yet.

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="border-0 shadow-sm card">

                    <div class="py-5 text-center card-body">

                        <i class="bi bi-collection fs-1 text-muted"></i>

                        <h5 class="mt-3">
                            No Batches Found
                        </h5>

                        <p class="mb-0 text-muted">
                            You are not enrolled in any batch yet.
                        </p>

                    </div>

                </div>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}

    <div class="mt-4">

        {{ $batches->links() }}

    </div>

</div>

@endsection
