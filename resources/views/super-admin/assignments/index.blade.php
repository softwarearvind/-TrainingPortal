@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid p-4">


    <div
        class="page-header d-flex justify-content-between align-items-center mb-4"
    >

        <div>

            <h3 class="mb-1">

                <i class="bi bi-clipboard-check"></i>

                Assignments

            </h3>

            <small>
                Manage course assignments
            </small>

        </div>


        <a
            href="{{ route('super-admin.assignments.create') }}"
            class="btn btn-gold"
        >

            <i class="bi bi-plus-lg"></i>

            Add Assignment

        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Assignment</th>

                            <th>Course</th>

                            <th>Batch</th>

                            <th>Marks</th>

                            <th>Due Date</th>

                            <th>Status</th>

                            <th width="200">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($assignments as $assignment)

                        <tr>

                            <td>
                                {{ $assignments->firstItem() + $loop->index }}
                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="assignment-icon">

                                        <i class="bi bi-clipboard-check"></i>

                                    </div>


                                    <div>

                                        <strong>
                                            {{ $assignment->title }}
                                        </strong>

                                        <br>

                                        @if($assignment->attachment)

                                            <small class="text-success">

                                                <i class="bi bi-paperclip"></i>

                                                {{ $assignment->attachment_name }}

                                            </small>

                                        @else

                                            <small class="text-muted">
                                                No attachment
                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $assignment->course->name ?? '-' }}
                            </td>


                            <td>

                                <span class="badge bg-info">

                                    {{ $assignment->batch->name ?? '-' }}

                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ number_format($assignment->total_marks, 2) }}
                                </strong>

                            </td>


                            <td>

                                @if($assignment->due_date)

                                    {{ $assignment->due_date->format('d M Y h:i A') }}

                                @else

                                    <span class="text-muted">
                                        No deadline
                                    </span>

                                @endif

                            </td>


                            <td>

                                @if($assignment->status === 'draft')

                                    <span class="badge bg-secondary">
                                        Draft
                                    </span>

                                @elseif($assignment->status === 'published')

                                    <span class="badge bg-success">
                                        Published
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Closed
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="d-flex gap-1">


                                    @if($assignment->attachment)

                                        <a
                                            href="{{ asset($assignment->attachment) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-success"
                                            title="Open Attachment"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                    @endif


                                    <a
                                        href="{{ route('super-admin.assignments.edit', $assignment) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form
                                        action="{{ route('super-admin.assignments.toggle-status', $assignment) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-warning"
                                            title="Change Status"
                                        >

                                            <i class="bi bi-arrow-repeat"></i>

                                        </button>

                                    </form>


                                    <form
                                        action="{{ route('super-admin.assignments.destroy', $assignment) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this assignment?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
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
                                    class="bi bi-clipboard-x fs-1 text-muted"
                                ></i>

                                <h5 class="mt-3">
                                    No assignments found
                                </h5>

                                <a
                                    href="{{ route('super-admin.assignments.create') }}"
                                    class="btn btn-gold"
                                >

                                    Add First Assignment

                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $assignments->links() }}

            </div>

        </div>

    </div>

</div>



@endsection
