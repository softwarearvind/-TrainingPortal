@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Students
            </h3>

            <p class="text-muted mb-0">
                Manage all training students
            </p>
        </div>

        <a href="{{ route('super-admin.students.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>

            Add Student
        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Student</th>

                            <th>Admission No.</th>

                            <th>Phone</th>

                            <th>Courses</th>

                            <th>Status</th>

                            <th class="text-end">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($students as $student)

                            <tr>

                                <td>
                                    {{ $students->firstItem() + $loop->index }}
                                </td>


                                <td>

                                    <div class="d-flex align-items-center">

                                        @if($student->image)

                                            <img
                                                src="{{ asset($student->image) }}"
                                                width="45"
                                                height="45"
                                                class="rounded-circle object-fit-cover me-2"
                                            >

                                        @else

                                            <div
                                                class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                                style="width:45px;height:45px;"
                                            >
                                                <i class="bi bi-person text-muted"></i>
                                            </div>

                                        @endif


                                        <div>

                                            <div class="fw-semibold">
                                                {{ $student->user->name }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $student->user->email }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <span class="badge bg-light text-dark">

                                        {{ $student->admission_no }}

                                    </span>

                                </td>


                                <td>
                                    {{ $student->phone ?? '-' }}
                                </td>


                                <td>

                                    <span class="badge bg-info-subtle text-info-emphasis">

                                        {{ $student->courses_count ?? $student->courses->count() }}

                                        Course(s)

                                    </span>

                                </td>


                                <td>

                                    @if($student->status)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        <a
                                            href="{{ route('super-admin.students.edit', $student) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        <form
                                            action="{{ route('super-admin.students.toggle-status', $student) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Change Status"
                                            >
                                                <i class="bi bi-power"></i>
                                            </button>

                                        </form>


                                        <form
                                            action="{{ route('super-admin.students.destroy', $student) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this student?')"
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

                                <td colspan="7"
                                    class="text-center py-5">

                                    <i class="bi bi-people fs-1 text-muted"></i>

                                    <h5 class="mt-3">
                                        No Students Found
                                    </h5>

                                    <p class="text-muted">
                                        Start by adding your first student.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $students->links() }}

            </div>

        </div>

    </div>

</div>



@endsection
