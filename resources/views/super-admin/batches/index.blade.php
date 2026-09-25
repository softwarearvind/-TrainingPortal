@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Batches
            </h3>

            <p class="text-muted mb-0">
                Manage training batches and student enrollments
            </p>
        </div>

        <a
            href="{{ route('super-admin.batches.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-lg"></i>
            Add Batch
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

                            <th>Batch</th>

                            <th>Course</th>

                            <th>Trainer</th>

                            <th>Schedule</th>

                            <th>Mode</th>

                            <th>Students</th>

                            <th>Status</th>

                            <th class="text-end">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($batches as $batch)

                            <tr>

                                <td>
                                    {{ $batches->firstItem() + $loop->index }}
                                </td>


                                <td>

                                    <div class="fw-semibold">
                                        {{ $batch->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $batch->batch_code }}
                                    </small>

                                </td>


                                <td>
                                    {{ $batch->course->name ?? '-' }}
                                </td>


                                <td>

                                    @if($batch->trainer)

                                        {{ $batch->trainer->name }}

                                    @else

                                        <span class="text-muted">
                                            Not Assigned
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div>
                                        {{ $batch->start_date->format('d M Y') }}
                                    </div>

                                    @if($batch->end_date)

                                        <small class="text-muted">
                                            to {{ $batch->end_date->format('d M Y') }}
                                        </small>

                                    @endif

                                </td>


                                <td>

                                    @php
                                        $modeClass = match($batch->training_mode) {
                                            'online' => 'bg-primary',
                                            'offline' => 'bg-success',
                                            'hybrid' => 'bg-warning text-dark',
                                        };
                                    @endphp

                                    <span class="badge {{ $modeClass }}">

                                        {{ ucfirst($batch->training_mode) }}

                                    </span>

                                </td>


                                <td>

                                    <span class="badge bg-info-subtle text-info-emphasis">

                                        {{ $batch->students_count }}
                                        / {{ $batch->capacity }}

                                    </span>

                                </td>


                                <td>

                                    @php
                                        $statusClass = match($batch->status) {
                                            'upcoming' => 'bg-info',
                                            'ongoing' => 'bg-success',
                                            'completed' => 'bg-secondary',
                                            'cancelled' => 'bg-danger',
                                        };
                                    @endphp

                                    <span class="badge {{ $statusClass }}">

                                        {{ ucfirst($batch->status) }}

                                    </span>

                                </td>


                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        <a
                                            href="{{ route('super-admin.batches.edit', $batch) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        <form
                                            action="{{ route('super-admin.batches.destroy', $batch) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this batch?')"
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
                                    colspan="9"
                                    class="text-center py-5"
                                >

                                    <i class="bi bi-collection fs-1 text-muted"></i>

                                    <h5 class="mt-3">
                                        No Batches Found
                                    </h5>

                                    <p class="text-muted">
                                        Create your first training batch.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $batches->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
