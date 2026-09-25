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

                <i class="bi bi-file-earmark-text"></i>

                Study Materials

            </h3>

            <small>
                Manage course study materials
            </small>

        </div>


        <a
            href="{{ route('super-admin.study-materials.create') }}"
            class="btn btn-gold"
        >

            <i class="bi bi-plus-lg"></i>

            Add Material

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

                            <th>Material</th>

                            <th>Course</th>

                            <th>Session</th>

                            <th>Type</th>

                            <th>Size</th>

                            <th>Status</th>

                            <th width="180">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($materials as $material)

                        <tr>

                            <td>
                                {{ $materials->firstItem() + $loop->index }}
                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="file-icon">

                                        @if($material->material_type === 'pdf')

                                            <i class="bi bi-file-earmark-pdf"></i>

                                        @elseif($material->material_type === 'document')

                                            <i class="bi bi-file-earmark-word"></i>

                                        @elseif($material->material_type === 'presentation')

                                            <i class="bi bi-file-earmark-slides"></i>

                                        @elseif($material->material_type === 'spreadsheet')

                                            <i class="bi bi-file-earmark-excel"></i>

                                        @elseif($material->material_type === 'zip')

                                            <i class="bi bi-file-earmark-zip"></i>

                                        @else

                                            <i class="bi bi-link-45deg"></i>

                                        @endif

                                    </div>


                                    <div>

                                        <strong>
                                            {{ $material->title }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">

                                            {{ $material->file_name ?? 'External Resource' }}

                                        </small>

                                    </div>

                                </div>

                            </td>


                            <td>

                                {{ $material->course->name ?? '-' }}

                            </td>


                            <td>

                                @if($material->trainingSession)

                                    <span class="badge bg-info">

                                        {{ $material->trainingSession->title }}

                                    </span>

                                @else

                                    <span class="text-muted">
                                        General
                                    </span>

                                @endif

                            </td>


                            <td>

                                <span class="badge bg-secondary">

                                    {{ ucfirst($material->material_type) }}

                                </span>

                            </td>


                            <td>

                                {{ $material->file_size ?? '-' }}

                            </td>


                            <td>

                                @if($material->status)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="d-flex gap-1">


                                    @if($material->file_path)

                                        <a
                                            href="{{ asset($material->file_path) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-success"
                                            title="Open"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                    @elseif($material->external_url)

                                        <a
                                            href="{{ $material->external_url }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-success"
                                        >

                                            <i class="bi bi-box-arrow-up-right"></i>

                                        </a>

                                    @endif


                                    <a
                                        href="{{ route('super-admin.study-materials.edit', $material) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form
                                        action="{{ route('super-admin.study-materials.toggle-status', $material) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-warning"
                                        >

                                            @if($material->status)

                                                <i class="bi bi-toggle-on"></i>

                                            @else

                                                <i class="bi bi-toggle-off"></i>

                                            @endif

                                        </button>

                                    </form>


                                    <form
                                        action="{{ route('super-admin.study-materials.destroy', $material) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this study material?')"
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
                                    class="bi bi-file-earmark-text fs-1 text-muted"
                                ></i>

                                <h5 class="mt-3">
                                    No study materials found
                                </h5>

                                <a
                                    href="{{ route('super-admin.study-materials.create') }}"
                                    class="btn btn-gold"
                                >

                                    Add First Material

                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $materials->links() }}

            </div>

        </div>

    </div>

</div>


@endsection
