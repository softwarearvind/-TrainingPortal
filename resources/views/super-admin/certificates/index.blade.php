@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Certificates
            </h3>

            <p class="text-muted mb-0">
                Manage student certificates and verification.
            </p>
        </div>

        <a
            href="{{ route('super-admin.certificates.create') }}"
            class="btn btn-dark">

            <i class="bi bi-plus-lg"></i>
            Generate Certificate

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
                        <th>Certificate No.</th>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Batch</th>
                        <th>Grade</th>
                        <th>Issue Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($certificates as $certificate)

                        <tr>

                            <td>
                                {{ $certificates->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <strong>
                                    {{ $certificate->certificate_no }}
                                </strong>
                            </td>

                            <td>
                                {{ $certificate->student->user->name ?? '-' }}
                            </td>

                            <td>
                                {{ $certificate->course->name ?? '-' }}
                            </td>

                            <td>
                                {{ $certificate->batch->name ?? '-' }}
                            </td>

                            <td>
                                {{ $certificate->grade ?? '-' }}
                            </td>

                            <td>
                                {{ $certificate->issue_date?->format('d M Y') }}
                            </td>

                            <td>

                                @if($certificate->status)

                                    <span class="badge bg-success">
                                        Valid
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Revoked
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a
                                    href="{{ route('super-admin.certificates.show', $certificate) }}"
                                    class="btn btn-sm btn-outline-primary">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a
                                    href="{{ route('super-admin.certificates.download', $certificate) }}"
                                    class="btn btn-sm btn-outline-success">

                                    <i class="bi bi-download"></i>

                                </a>

                                <a
                                    href="{{ route('super-admin.certificates.edit', $certificate) }}"
                                    class="btn btn-sm btn-outline-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form
                                    action="{{ route('super-admin.certificates.destroy', $certificate) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Delete certificate?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-sm btn-outline-danger">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="9"
                                class="text-center py-5">

                                <i class="bi bi-award fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    No certificates found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            {{ $certificates->links() }}

        </div>

    </div>

</div>



@endsection
