@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')


<div class="container-fluid p-4">

    <div class="page-header mb-4">

        <h3 class="mb-1">
            <i class="bi bi-plus-circle"></i>
            Add Training Video
        </h3>

        <small>
            Add YouTube, Vimeo, external or uploaded video
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
        action="{{ route('super-admin.videos.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="row g-4">

            {{-- Main --}}

            <div class="col-lg-8">

                <div class="card">

                    <div class="card-body p-4">

                        <h5 class="section-title">
                            Video Information
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
                                    General Course Video
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

                            <small class="text-muted">
                                Optional. Select if this video belongs to a specific training session.
                            </small>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Video Title *
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ old('title') }}"
                                placeholder="Example: Laravel 13 Introduction"
                                required
                            >

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Video Type *
                                </label>

                                <select
                                    name="video_type"
                                    id="video_type"
                                    class="form-select"
                                    required
                                >

                                    <option value="youtube">
                                        YouTube
                                    </option>

                                    <option value="vimeo">
                                        Vimeo
                                    </option>

                                    <option value="external">
                                        External URL
                                    </option>

                                    <option value="upload">
                                        Upload Video
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Duration
                                </label>

                                <input
                                    type="text"
                                    name="duration"
                                    class="form-control"
                                    value="{{ old('duration') }}"
                                    placeholder="Example: 45:30"
                                >

                            </div>

                        </div>


                        <div
                            class="mb-3"
                            id="video-url-section"
                        >

                            <label class="form-label">
                                Video URL
                            </label>

                            <input
                                type="url"
                                name="video_url"
                                class="form-control"
                                value="{{ old('video_url') }}"
                                placeholder="https://www.youtube.com/watch?v=..."
                            >

                        </div>


                        <div
                            class="mb-3"
                            id="video-file-section"
                            style="display:none;"
                        >

                            <label class="form-label">
                                Upload Video
                            </label>

                            <input
                                type="file"
                                name="video_file"
                                class="form-control"
                                accept=".mp4,.webm,.mov"
                            >

                            <small class="text-muted">
                                Allowed: MP4, WEBM, MOV. Maximum 50MB.
                            </small>

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

                            <small class="text-muted">
                                Recommended size: 1280 × 720
                            </small>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                                placeholder="Video description..."
                            >{{ old('description') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Settings --}}

            <div class="col-lg-4">

                <div class="card">

                    <div class="card-body p-4">

                        <h5 class="section-title">
                            Video Settings
                        </h5>


                        <div class="mb-3">

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

                            <small class="text-muted">
                                Smaller number appears first.
                            </small>

                        </div>


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

                            <strong>Video Types</strong>

                            <ul class="mb-0 mt-2">

                                <li>YouTube</li>
                                <li>Vimeo</li>
                                <li>External URL</li>
                                <li>Local Upload</li>

                            </ul>

                        </div>


                        <div class="d-grid gap-2">

                            <button
                                type="submit"
                                class="btn btn-gold"
                            >
                                <i class="bi bi-check-lg"></i>
                                Save Video
                            </button>


                            <a
                                href="{{ route('super-admin.videos.index') }}"
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

    const videoType =
        document.getElementById('video_type');

    const urlSection =
        document.getElementById('video-url-section');

    const fileSection =
        document.getElementById('video-file-section');


    function toggleVideoSource()
    {
        if (videoType.value === 'upload') {

            urlSection.style.display = 'none';

            fileSection.style.display = 'block';

        } else {

            urlSection.style.display = 'block';

            fileSection.style.display = 'none';
        }
    }


    videoType.addEventListener(
        'change',
        toggleVideoSource
    );

    toggleVideoSource();

</script>

@endsection
