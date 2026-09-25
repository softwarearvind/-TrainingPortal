@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Training Sessions
            </h3>

            <p class="text-muted mb-0">
                Manage online, offline and hybrid training classes
            </p>

        </div>

        <a
            href="{{ route('super-admin.training-sessions.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-lg"></i>
            Add Training Session
        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Session</th>

                            <th>Batch</th>

                            <th>Trainer</th>

                            <th>Date & Time</th>

                            <th>Mode</th>

                            <th>Status</th>

                            <th class="text-end">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($sessions as $session)

                            <tr>

                                <td>
                                    {{ $sessions->firstItem() + $loop->index }}
                                </td>


                                <td>

                                    <div class="fw-semibold">
                                        {{ $session->title }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $session->session_code }}
                                    </small>

                                </td>


                                <td>

                                    <div>
                                        {{ $session->batch->name ?? '-' }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $session->batch->course->name ?? '' }}
                                    </small>

                                </td>


                                <td>
                                    {{ $session->trainer->name ?? 'Not Assigned' }}
                                </td>


                                <td>

                                    <div class="fw-semibold">

                                        {{ $session->session_date->format('d M Y') }}

                                    </div>

                                    <small class="text-muted">

                                        {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}

                                        -

                                        {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}

                                    </small>

                                </td>


                                <td>

                                    @php

                                        $modeClass = match(
                                            $session->training_mode
                                        ) {

                                            'online' =>
                                                'bg-primary',

                                            'offline' =>
                                                'bg-success',

                                            'hybrid' =>
                                                'bg-warning text-dark',

                                        };

                                    @endphp


                                    <span
                                        class="badge {{ $modeClass }}"
                                    >
                                        {{ ucfirst($session->training_mode) }}
                                    </span>

                                </td>


                                <td>

                                    @php

                                        $statusClass = match(
                                            $session->status
                                        ) {

                                            'scheduled' =>
                                                'bg-info',

                                            'ongoing' =>
                                                'bg-success',

                                            'completed' =>
                                                'bg-secondary',

                                            'cancelled' =>
                                                'bg-danger',

                                        };

                                    @endphp


                                    <span
                                        class="badge {{ $statusClass }}"
                                    >
                                        {{ ucfirst($session->status) }}
                                    </span>

                                </td>


                                <td class="text-end">

                                    <div
                                        class="d-flex justify-content-end gap-1"
                                    >

                                        @if(
                                            in_array(
                                                $session->training_mode,
                                                ['online', 'hybrid']
                                            )
                                            && $session->meeting_link
                                        )

                                            <a
                                                href="{{ $session->meeting_link }}"
                                                target="_blank"
                                                class="btn btn-sm btn-outline-success"
                                                title="Join Meeting"
                                            >
                                                <i class="bi bi-camera-video"></i>
                                            </a>

                                        @endif


                                        <a
                                            href="{{ route('super-admin.training-sessions.edit', $session) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        <form
                                            action="{{ route('super-admin.training-sessions.destroy', $session) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this session?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="bi bi-camera-video fs-1 text-muted"
                                    ></i>

                                    <h5 class="mt-3">
                                        No Training Sessions Found
                                    </h5>

                                    <p class="text-muted">
                                        Create your first training session.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $sessions->links() }}

            </div>

        </div>

    </div>

</div>



@endsection
