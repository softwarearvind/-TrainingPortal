@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Add Training Session
        </h3>

        <p class="text-muted mb-0">
            Schedule an online, offline or hybrid class
        </p>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('super-admin.training-sessions.store') }}"
        method="POST"
    >

        @csrf


        <div class="row g-4">


            <div class="col-lg-8">

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-camera-video me-2"></i>

                            Session Information

                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">


                            {{-- TITLE --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Session Title
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    class="form-control"
                                    value="{{ old('title') }}"
                                    placeholder="Laravel Introduction"
                                    required
                                >

                            </div>


                            {{-- CODE --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Session Code
                                </label>

                                <input
                                    type="text"
                                    name="session_code"
                                    class="form-control"
                                    value="{{ old('session_code') }}"
                                    placeholder="LAR-SESSION-001"
                                    required
                                >

                            </div>


                            {{-- BATCH --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Batch
                                </label>

                                <select
                                    name="batch_id"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select Batch
                                    </option>

                                    @foreach($batches as $batch)

                                        <option
                                            value="{{ $batch->id }}"
                                            @selected(
                                                old('batch_id') == $batch->id
                                            )
                                        >

                                            {{ $batch->name }}
                                            —
                                            {{ $batch->course->name ?? '' }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- TRAINER --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Trainer
                                </label>

                                <select
                                    name="trainer_id"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select Trainer
                                    </option>

                                    @foreach($trainers as $trainer)

                                        <option
                                            value="{{ $trainer->id }}"
                                            @selected(
                                                old('trainer_id') == $trainer->id
                                            )
                                        >
                                            {{ $trainer->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- DATE --}}

                            <div class="col-md-4">

                                <label class="form-label">
                                    Session Date
                                </label>

                                <input
                                    type="date"
                                    name="session_date"
                                    class="form-control"
                                    value="{{ old('session_date') }}"
                                    required
                                >

                            </div>


                            {{-- START TIME --}}

                            <div class="col-md-4">

                                <label class="form-label">
                                    Start Time
                                </label>

                                <input
                                    type="time"
                                    name="start_time"
                                    class="form-control"
                                    value="{{ old('start_time') }}"
                                    required
                                >

                            </div>


                            {{-- END TIME --}}

                            <div class="col-md-4">

                                <label class="form-label">
                                    End Time
                                </label>

                                <input
                                    type="time"
                                    name="end_time"
                                    class="form-control"
                                    value="{{ old('end_time') }}"
                                    required
                                >

                            </div>


                            {{-- MODE --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Training Mode
                                </label>

                                <select
                                    name="training_mode"
                                    id="trainingMode"
                                    class="form-select"
                                    required
                                >

                                    <option value="online">
                                        Online
                                    </option>

                                    <option value="offline">
                                        Offline
                                    </option>

                                    <option value="hybrid">
                                        Hybrid
                                    </option>

                                </select>

                            </div>


                            {{-- STATUS --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    class="form-select"
                                >

                                    <option value="scheduled">
                                        Scheduled
                                    </option>

                                    <option value="ongoing">
                                        Ongoing
                                    </option>

                                    <option value="completed">
                                        Completed
                                    </option>

                                    <option value="cancelled">
                                        Cancelled
                                    </option>

                                </select>

                            </div>


                            {{-- TOPIC --}}

                            <div class="col-12">

                                <label class="form-label">
                                    Topic
                                </label>

                                <textarea
                                    name="topic"
                                    class="form-control"
                                    rows="3"
                                    placeholder="What will be covered in this session?"
                                >{{ old('topic') }}</textarea>

                            </div>


                            {{-- NOTES --}}

                            <div class="col-12">

                                <label class="form-label">
                                    Notes
                                </label>

                                <textarea
                                    name="notes"
                                    class="form-control"
                                    rows="3"
                                >{{ old('notes') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ONLINE INFORMATION --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-camera-video me-2"></i>

                            Online Training Details

                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Meeting Platform
                                </label>

                                <select
                                    name="meeting_platform"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select Platform
                                    </option>

                                    <option value="Google Meet">
                                        Google Meet
                                    </option>

                                    <option value="Zoom">
                                        Zoom
                                    </option>

                                    <option value="Microsoft Teams">
                                        Microsoft Teams
                                    </option>

                                    <option value="Other">
                                        Other
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Meeting Link
                                </label>

                                <input
                                    type="url"
                                    name="meeting_link"
                                    class="form-control"
                                    value="{{ old('meeting_link') }}"
                                    placeholder="https://meet.google.com/..."
                                >

                            </div>


                            <div class="col-12">

                                <label class="form-label">
                                    Recording Link
                                </label>

                                <input
                                    type="url"
                                    name="recording_link"
                                    class="form-control"
                                    value="{{ old('recording_link') }}"
                                    placeholder="https://..."
                                >

                            </div>

                        </div>

                    </div>

                </div>


                {{-- OFFLINE INFORMATION --}}

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-building me-2"></i>

                            Offline Training Details

                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Room
                                </label>

                                <input
                                    type="text"
                                    name="room"
                                    class="form-control"
                                    value="{{ old('room') }}"
                                    placeholder="Room 101"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Location
                                </label>

                                <input
                                    type="text"
                                    name="location"
                                    class="form-control"
                                    value="{{ old('location') }}"
                                    placeholder="Training Center, Sector 62"
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RIGHT SIDE --}}

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold">
                            Session Summary
                        </h5>

                        <hr>

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Mode
                            </small>

                            <strong>
                                Online / Offline / Hybrid
                            </strong>

                        </div>


                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Session
                            </small>

                            <strong>
                                Training Class
                            </strong>

                        </div>


                        <div class="alert alert-info">

                            <i class="bi bi-info-circle me-2"></i>

                            Online sessions can contain a meeting
                            link, while offline sessions can contain
                            room and location information.

                        </div>


                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('super-admin.training-sessions.index') }}"
                                class="btn btn-light w-50"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary w-50"
                            >
                                <i class="bi bi-check-lg"></i>
                                Save
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>



@endsection
