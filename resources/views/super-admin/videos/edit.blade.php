@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid p-4">

    <div class="page-header mb-4">

        <h3 class="mb-1">

            <i class="bi bi-pencil-square"></i>

            Edit Training Video

        </h3>

        <small>
            Update video information
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
        action="{{ route('super-admin.videos.update', $video) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <div class="row g-4">


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

                                @foreach($courses as $course)

                                    <option
                                        value="{{ $course->id }}"
                                        {{ old('course_id', $video->course_id) == $course->id ? 'selected' : '' }}
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
                                        {{ old('training_session_id', $video->training_session_id) == $session->id ? 'selected' : '' }}
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
                                Video Title *
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ old('title', $video->title) }}"
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
                                >

                                    <option
                                        value="youtube"
                                        {{ old('video_type', $video->video_type) == 'youtube' ? 'selected' : '' }}
                                    >
                                        YouTube
                                    </option>

                                    <option
                                        value="vimeo"
                                        {{ old('video_type', $video->video_type) == 'vimeo' ? 'selected' : '' }}
                                    >
                                        Vimeo
                                    </option>

                                    <option
                                        value="external"
                                        {{ old('video_type', $video->video_type) == 'external' ? 'selected' : '' }}
                                    >
                                        External URL
                                    </option>

                                    <option
                                        value="upload"
                                        {{ old('video_type', $video->video_type) == 'upload' ? 'selected' : '' }}
                                    >
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
                                    value="{{ old('duration', $video->duration) }}"
                                    placeholder="45:30"
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
                                value="{{ old('video_url', $video->video_url) }}"
                            >

                        </div>


                        <div
                            class="mb-3"
                            id="video-file-section"
                        >

                            <label class="form-label">
                                Replace Video
                            </label>

                            <input
                                type="file"
                                name="video_file"
                                class="form-control"
                                accept=".mp4,.webm,.mov"
                            >

                            @if($video->video_file)

                                <small class="text-success">

                                    Current uploaded video exists.

                                </small>

                            @endif

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Replace Thumbnail
                            </label>

                            <input
                                type="file"
                                name="thumbnail"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >


                            @if($video->thumbnail)

                                <div class="mt-3">

                                    <img
                                        src="{{ asset($video->thumbnail) }}"
                                        class="current-thumb"
                                    >

                                </div>

                            @endif

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                            >{{ old('description', $video->description) }}</textarea>

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


                        <div class="mb-3">

                            <label class="form-label">
                                Sort Order
                            </label>

                            <input
                                type="number"
                                name="sort_order"
                                class="form-control"
                                value="{{ old('sort_order', $video->sort_order) }}"
                                min="0"
                            >

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                            >

                                <option
                                    value="1"
                                    {{ old('status', $video->status) == 1 ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="0"
                                    {{ old('status', $video->status) == 0 ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                            </select>

                        </div>


                        <div class="d-grid gap-2">

                            <button
                                type="submit"
                                class="btn btn-gold"
                            >

                                <i class="bi bi-check-lg"></i>

                                Update Video

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
