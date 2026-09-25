@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <form
    action="{{ route('super-admin.study-materials.update', $studyMaterial) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label class="form-label">
            Course *
        </label>

        <select
            name="course_id"
            class="form-select"
            required
        >

            @foreach($courses as $course)

                <option
                    value="{{ $course->id }}"
                    {{ old('course_id', $studyMaterial->course_id) == $course->id ? 'selected' : '' }}
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
                    {{ old(
                        'training_session_id',
                        $studyMaterial->training_session_id
                    ) == $session->id ? 'selected' : '' }}
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
            value="{{ old('title', $studyMaterial->title) }}"
            required
        >

    </div>


    <div class="mb-3">

        <label class="form-label">
            Material Type *
        </label>

        <select
            name="material_type"
            id="material_type"
            class="form-select"
        >

            <option
                value="pdf"
                {{ old('material_type', $studyMaterial->material_type) === 'pdf' ? 'selected' : '' }}
            >
                PDF
            </option>

            <option
                value="document"
                {{ old('material_type', $studyMaterial->material_type) === 'document' ? 'selected' : '' }}
            >
                Word Document
            </option>

            <option
                value="presentation"
                {{ old('material_type', $studyMaterial->material_type) === 'presentation' ? 'selected' : '' }}
            >
                PowerPoint
            </option>

            <option
                value="spreadsheet"
                {{ old('material_type', $studyMaterial->material_type) === 'spreadsheet' ? 'selected' : '' }}
            >
                Excel
            </option>

            <option
                value="zip"
                {{ old('material_type', $studyMaterial->material_type) === 'zip' ? 'selected' : '' }}
            >
                ZIP
            </option>

            <option
                value="external"
                {{ old('material_type', $studyMaterial->material_type) === 'external' ? 'selected' : '' }}
            >
                External URL
            </option>

        </select>

    </div>


    <div id="file-section">

        <label class="form-label">
            Replace File
        </label>

        <input
            type="file"
            name="file"
            class="form-control"
            accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip"
        >

        @if($studyMaterial->file_name)

            <small class="text-success">

                Current:
                {{ $studyMaterial->file_name }}

                ({{ $studyMaterial->file_size }})

            </small>

        @endif

    </div>


    <div
        id="url-section"
        class="mt-3"
    >

        <label class="form-label">
            External URL
        </label>

        <input
            type="url"
            name="external_url"
            class="form-control"
            value="{{ old(
                'external_url',
                $studyMaterial->external_url
            ) }}"
        >

    </div>


    <div class="mb-3 mt-3">

        <label class="form-label">
            Sort Order
        </label>

        <input
            type="number"
            name="sort_order"
            class="form-control"
            value="{{ old(
                'sort_order',
                $studyMaterial->sort_order
            ) }}"
            min="0"
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
        >{{ old(
            'description',
            $studyMaterial->description
        ) }}</textarea>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Status
        </label>

        <select
            name="status"
            class="form-select"
        >

            <option
                value="1"
                {{ old('status', $studyMaterial->status) == 1 ? 'selected' : '' }}
            >
                Active
            </option>

            <option
                value="0"
                {{ old('status', $studyMaterial->status) == 0 ? 'selected' : '' }}
            >
                Inactive
            </option>

        </select>

    </div>


    <button
        type="submit"
        class="btn btn-primary"
    >
        Update Material
    </button>

</form>

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
