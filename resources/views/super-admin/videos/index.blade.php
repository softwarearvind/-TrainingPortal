@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid p-4">

    {{-- Header --}}

    <div
        class="page-header d-flex justify-content-between align-items-center mb-4"
    >

        <div>

            <h3 class="mb-1">
                <i class="bi bi-play-circle"></i>
                Training Videos
            </h3>

            <small>
                Manage course training videos
            </small>

        </div>


        <a
            href="{{ route('super-admin.videos.create') }}"
            class="btn btn-gold"
        >
            <i class="bi bi-plus-lg"></i>
            Add Video
        </a>

    </div>


    {{-- Success --}}

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Table --}}

    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Video</th>

                            <th>Course</th>

                            <th>Session</th>

                            <th>Type</th>

                            <th>Duration</th>

                            <th>Status</th>

                            <th width="180">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($videos as $video)

                        <tr>

                            <td>
                                {{ $videos->firstItem() + $loop->index }}
                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if($video->thumbnail)

                                        <img
                                            src="{{ asset($video->thumbnail) }}"
                                            class="video-thumb"
                                            alt="{{ $video->title }}"
                                        >

                                    @else

                                        <div class="video-icon">

                                            <i class="bi bi-play-fill"></i>

                                        </div>

                                    @endif


                                    <div>

                                        <strong>
                                            {{ $video->title }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ $video->slug }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            <td>

                                {{ $video->course->name ?? '-' }}

                            </td>


                            <td>

                                @if($video->trainingSession)

                                    <span class="badge bg-info">

                                        {{ $video->trainingSession->title }}

                                    </span>

                                @else

                                    <span class="text-muted">
                                        General Course Video
                                    </span>

                                @endif

                            </td>


                            <td>

                                @php

                                    $typeClass = match($video->video_type) {

                                        'youtube' => 'danger',

                                        'vimeo' => 'primary',

                                        'upload' => 'success',

                                        default => 'secondary'

                                    };

                                @endphp

                                <span
                                    class="badge bg-{{ $typeClass }}"
                                >
                                    {{ ucfirst($video->video_type) }}
                                </span>

                            </td>


                            <td>

                                {{ $video->duration ?: '-' }}

                            </td>


                            <td>

                                @if($video->status)

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

                                    <a
                                        href="{{ route('super-admin.videos.edit', $video) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    <form
                                        action="{{ route('super-admin.videos.toggle-status', $video) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="btn btn-sm btn-outline-warning"
                                            type="submit"
                                        >

                                            @if($video->status)

                                                <i class="bi bi-toggle-on"></i>

                                            @else

                                                <i class="bi bi-toggle-off"></i>

                                            @endif

                                        </button>

                                    </form>


                                    <form
                                        action="{{ route('super-admin.videos.destroy', $video) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this video?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm btn-outline-danger"
                                            type="submit"
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
                                    class="bi bi-camera-video fs-1 text-muted"
                                ></i>

                                <h5 class="mt-3">
                                    No videos found
                                </h5>

                                <a
                                    href="{{ route('super-admin.videos.create') }}"
                                    class="btn btn-gold"
                                >
                                    Add First Video
                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $videos->links() }}

            </div>

        </div>

    </div>

</div>


@endsection
