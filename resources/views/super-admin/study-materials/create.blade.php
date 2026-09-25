@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid p-4">


    <div class="page-header mb-4">

        <h3 class="mb-1">

            <i class="bi bi-file-earmark-plus"></i>

            Add Study Material

        </h3>

        <small>
            Upload PDF, documents or add external resources
        </small>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('super-admin.study-materials.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="row g-4">


            <div class="col-lg-8">

                <div class="card">

                    <div class="card-body p-4">

                        <h5 class="section-title">
                            Material Information
                        </h5>


                        <div class="mb-3">

                            <label class="form-label">
                                Course *
                            </label>

                            <select
                                name="course_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Select Course
                                </option>

                                @foreach($courses as $course)

                                    <option
                                        value="{{ $course->id }}"
                                        {{ old('course_id') == $course->id ? 'selected' : '' }}
                                    >

                                        {{ $course->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Training Session
                            </label>

                            <select
                                name="training_session_id"
                                class="form-select"
                            >

                                <option value="">
                                    General Course Material
                                </option>

                                @foreach($trainingSessions as $session)

                                    <option
                                        value="{{ $session->id }}"
                                        {{ old('training_session_id') == $session->id ? 'selected' : '' }}
                                    >

                                        {{ $session->title }}

                                        -
                                        {{ $session->batch->name ?? 'Batch' }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Material Title *
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ old('title') }}"
                                placeholder="Example: Laravel 13 Complete Notes"
                                required
                            >

                        </div>


                        <div class="row">


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Material Type *
                                </label>

                                <select
                                    name="material_type"
                                    id="material_type"
                                    class="form-select"
                                >

                                    <option value="pdf">
                                        PDF
                                    </option>

                                    <option value="document">
                                        Word Document
                                    </option>

                                    <option value="presentation">
                                        PowerPoint
                                    </option>

                                    <option value="spreadsheet">
                                        Excel
                                    </option>

                                    <option value="zip">
                                        ZIP
                                    </option>

                                    <option value="external">
                                        External URL
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Sort Order
                                </label>

                                <input
                                    type="number"
                                    name="sort_order"
                                    class="form-control"
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                                >

                            </div>

                        </div>


                        <div
                            class="mb-3"
                            id="file-section"
                        >

                            <label class="form-label">
                                Material File
                            </label>

                            <input
                                type="file"
                                name="file"
                                class="form-control"
                                accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip"
                            >

                            <small class="text-muted">

                                Maximum file size: 20MB

                            </small>

                        </div>


                        <div
                            class="mb-3"
                            id="url-section"
                            style="display:none;"
                        >

                            <label class="form-label">
                                External URL
                            </label>

                            <input
                                type="url"
                                name="external_url"
                                class="form-control"
                                value="{{ old('external_url') }}"
                                placeholder="https://example.com/material.pdf"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Thumbnail
                            </label>

                            <input
                                type="file"
                                name="thumbnail"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                                placeholder="Describe this study material..."
                            >{{ old('description') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="card">

                    <div class="card-body p-4">

                        <h5 class="section-title">
                            Settings
                        </h5>


                        <div class="mb-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                            >

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>


                        <div class="alert alert-info">

                            <i class="bi bi-info-circle"></i>

                            <strong>Supported Files</strong>

                            <ul class="mb-0 mt-2">

                                <li>PDF</li>
                                <li>DOC / DOCX</li>
                                <li>PPT / PPTX</li>
                                <li>XLS / XLSX</li>
                                <li>ZIP</li>

                            </ul>

                        </div>


                        <div class="d-grid gap-2">

                            <button
                                type="submit"
                                class="btn btn-gold"
                            >

                                <i class="bi bi-check-lg"></i>

                                Save Material

                            </button>


                            <a
                                href="{{ route('super-admin.study-materials.index') }}"
                                class="btn btn-light"
                            >

                                Cancel

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


<script>

    const materialType =
        document.getElementById('material_type');

    const fileSection =
        document.getElementById('file-section');

    const urlSection =
        document.getElementById('url-section');


    function toggleMaterialSource()
    {

        if (
            materialType.value === 'external'
        ) {

            fileSection.style.display = 'none';

            urlSection.style.display = 'block';

        } else {

            fileSection.style.display = 'block';

            urlSection.style.display = 'none';

        }

    }


    materialType.addEventListener(
        'change',
        toggleMaterialSource
    );

    toggleMaterialSource();

</script>


@endsection
