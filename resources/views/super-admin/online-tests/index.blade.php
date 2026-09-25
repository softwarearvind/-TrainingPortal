@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Online Tests / MCQ
            </h3>

            <p class="text-muted mb-0">
                Manage online tests and multiple choice questions.
            </p>
        </div>

        <a href="{{ route('super-admin.online-tests.create') }}"
           class="btn btn-dark">
            <i class="bi bi-plus-lg"></i>
            Create Test
        </a>

    </div>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Test</th>
                            <th>Course</th>
                            <th>Batch</th>
                            <th>Questions</th>
                            <th>Marks</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($tests as $test)

                        <tr>

                            <td>
                                {{ $tests->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <strong>
                                    {{ $test->title }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $test->start_date?->format('d M Y H:i') ?? 'No start date' }}
                                </small>
                            </td>

                            <td>
                                {{ $test->course->name ?? '-' }}
                            </td>

                            <td>
                                {{ $test->batch->name ?? '-' }}
                            </td>

                            <td>
                                <span class="badge bg-info">
                                    {{ $test->questions_count }}
                                </span>
                            </td>

                            <td>
                                {{ number_format($test->total_marks, 2) }}
                            </td>

                            <td>
                                {{ $test->duration_minutes }} min
                            </td>

                            <td>

                                @if($test->status === 'published')

                                    <span class="badge bg-success">
                                        Published
                                    </span>

                                @elseif($test->status === 'closed')

                                    <span class="badge bg-danger">
                                        Closed
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Draft
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('super-admin.online-tests.show', $test) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('super-admin.online-tests.edit', $test) }}"
                                   class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form
                                    action="{{ route('super-admin.online-tests.toggle-status', $test) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>

                                </form>

                                <form
                                    action="{{ route('super-admin.online-tests.destroy', $test) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Delete this test?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="text-center py-5">

                                <i class="bi bi-clipboard-x fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    No online tests found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            {{ $tests->links() }}

        </div>

    </div>

</div>


@endsection
