@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Add Batch
        </h3>

        <p class="text-muted mb-0">
            Create a new training batch
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
        action="{{ route('super-admin.batches.store') }}"
        method="POST"
    >

        @csrf


        <div class="row g-4">


            {{-- BASIC DETAILS --}}

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-collection me-2"></i>
                            Batch Information
                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Batch Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    placeholder="Laravel Morning Batch"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Batch Code
                                </label>

                                <input
                                    type="text"
                                    name="batch_code"
                                    class="form-control"
                                    value="{{ old('batch_code') }}"
                                    placeholder="LAR-SEP-2026"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Course
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
                                            @selected(old('course_id') == $course->id)
                                        >
                                            {{ $course->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


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
                                            @selected(old('trainer_id') == $trainer->id)
                                        >
                                            {{ $trainer->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Start Date
                                </label>

                                <input
                                    type="date"
                                    name="start_date"
                                    class="form-control"
                                    value="{{ old('start_date') }}"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    End Date
                                </label>

                                <input
                                    type="date"
                                    name="end_date"
                                    class="form-control"
                                    value="{{ old('end_date') }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Start Time
                                </label>

                                <input
                                    type="time"
                                    name="start_time"
                                    class="form-control"
                                    value="{{ old('start_time') }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    End Time
                                </label>

                                <input
                                    type="time"
                                    name="end_time"
                                    class="form-control"
                                    value="{{ old('end_time') }}"
                                >

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Training Mode
                                </label>

                                <select
                                    name="training_mode"
                                    class="form-select"
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


                            <div class="col-md-4">

                                <label class="form-label">
                                    Capacity
                                </label>

                                <input
                                    type="number"
                                    name="capacity"
                                    class="form-control"
                                    value="{{ old('capacity', 30) }}"
                                    min="1"
                                    required
                                >

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    class="form-select"
                                >

                                    <option value="upcoming">
                                        Upcoming
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
                                    Description
                                </label>

                                <textarea
                                    name="description"
                                    class="form-control"
                                    rows="4"
                                >{{ old('description') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- STUDENTS --}}

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-people me-2"></i>

                            Enroll Students

                        </h5>

                    </div>


                    <div class="card-body">

                        <select
                            name="students[]"
                            class="form-select"
                            multiple
                            size="12"
                        >

                            @foreach($students as $student)

                                <option
                                    value="{{ $student->id }}"
                                    @selected(
                                        in_array(
                                            $student->id,
                                            old('students', [])
                                        )
                                    )
                                >

                                    {{ $student->user->name }}
                                    —
                                    {{ $student->admission_no }}

                                </option>

                            @endforeach

                        </select>


                        <small class="text-muted">

                            Select students to enroll in this batch.
                            Maximum students depend on capacity.

                        </small>

                    </div>

                </div>


                <div class="d-flex gap-2 mt-4">

                    <a
                        href="{{ route('super-admin.batches.index') }}"
                        class="btn btn-light w-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary w-50"
                    >
                        <i class="bi bi-check-lg"></i>
                        Save Batch
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>



@endsection
