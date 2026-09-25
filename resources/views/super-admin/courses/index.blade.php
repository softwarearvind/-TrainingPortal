@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

<div class="container-fluid p-4">

    {{-- Header --}}
    <div class="page-header mb-4">

        <div class="d-flex
                    justify-content-between
                    align-items-center">

            <div>
                <h3 class="mb-1">
                    <i class="bi bi-book"></i>
                    Courses
                </h3>

                <p class="mb-0 text-white-50">
                    Manage all training courses
                </p>
            </div>

            <a href="{{ route('super-admin.courses.create') }}"
               class="btn btn-gold">

                <i class="bi bi-plus-lg"></i>

                Add Course
            </a>

        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Course Table --}}
    <div class="card course-card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">

                    <tr>

                        <th class="px-3">#</th>

                        <th>Image</th>

                        <th>Course</th>

                        <th>Category</th>

                        <th>Mode</th>

                        <th>Duration</th>

                        <th>Fee</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($courses as $course)

                        <tr>

                            <td class="px-3">
                                {{ $courses->firstItem() + $loop->index }}
                            </td>


                            {{-- Image --}}
                            <td>

                                @if($course->image)

                                    <img
                                        src="{{ asset($course->image) }}"
                                        class="course-image">

                                @else

                                    <div class="no-image">

                                        <i class="bi bi-book"></i>

                                    </div>

                                @endif

                            </td>


                            {{-- Course --}}
                            <td>

                                <strong>
                                    {{ $course->name }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $course->slug }}
                                </small>

                            </td>


                            {{-- Category --}}
                            <td>

                                <span class="badge bg-secondary">

                                    {{ $course->category->name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- Mode --}}
                            <td>

                                @if($course->training_mode === 'online')

                                    <span class="badge bg-primary">
                                        Online
                                    </span>

                                @elseif($course->training_mode === 'offline')

                                    <span class="badge bg-warning text-dark">
                                        Offline
                                    </span>

                                @else

                                    <span class="badge bg-info text-dark">
                                        Hybrid
                                    </span>

                                @endif

                            </td>


                            {{-- Duration --}}
                            <td>
                                {{ $course->duration ?: '-' }}
                            </td>


                            {{-- Fee --}}
                            <td>

                                ₹{{ number_format($course->fee, 2) }}

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($course->status)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route(
                                            'super-admin.courses.edit',
                                            $course
                                        ) }}"
                                        class="btn btn-sm btn-primary">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form
                                        action="{{ route(
                                            'super-admin.courses.toggle-status',
                                            $course
                                        ) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="btn btn-sm btn-warning">

                                            <i class="bi bi-power"></i>

                                        </button>

                                    </form>


                                    <form
                                        action="{{ route(
                                            'super-admin.courses.destroy',
                                            $course
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Delete this course?'
                                        )">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm btn-danger">

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
                                class="text-center py-5">

                                <i
                                    class="bi bi-book fs-1 text-muted">
                                </i>

                                <h5 class="mt-2">
                                    No courses found
                                </h5>

                                <p class="text-muted">
                                    Create your first training course.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Pagination --}}
    <div class="mt-4">

        {{ $courses->links() }}

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


@endsection
