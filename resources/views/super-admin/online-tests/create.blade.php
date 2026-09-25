@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold">
            Create Online Test
        </h3>

        <p class="text-muted">
            Create a new MCQ based online test.
        </p>

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
        action="{{ route('super-admin.online-tests.store') }}"
        method="POST">

        @csrf


        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Test Information
                        </h5>


                        <div class="mb-3">

                            <label class="form-label">
                                Test Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ old('title') }}"
                                placeholder="Laravel Basic MCQ Test"
                                required>

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Course
                                </label>

                                <select
                                    name="course_id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Select Course
                                    </option>

                                    @foreach($courses as $course)

                                        <option
                                            value="{{ $course->id }}"
                                            @selected(old('course_id') == $course->id)>

                                            {{ $course->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Batch
                                </label>

                                <select
                                    name="batch_id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Select Batch
                                    </option>

                                    @foreach($batches as $batch)

                                        <option
                                            value="{{ $batch->id }}"
                                            @selected(old('batch_id') == $batch->id)>

                                            {{ $batch->name }}
                                            -
                                            {{ $batch->course->name ?? '' }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="form-control">{{ old('description') }}</textarea>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Instructions
                            </label>

                            <textarea
                                name="instructions"
                                rows="5"
                                class="form-control"
                                placeholder="Read all questions carefully...">{{ old('instructions') }}</textarea>

                        </div>


                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Duration
                                </label>

                                <div class="input-group">

                                    <input
                                        type="number"
                                        name="duration_minutes"
                                        class="form-control"
                                        value="{{ old('duration_minutes', 30) }}"
                                        min="1"
                                        required>

                                    <span class="input-group-text">
                                        Minutes
                                    </span>

                                </div>

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Passing Marks
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="passing_marks"
                                    class="form-control"
                                    value="{{ old('passing_marks', 40) }}"
                                    min="0"
                                    required>

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    class="form-select">

                                    <option value="draft">
                                        Draft
                                    </option>

                                    <option value="published">
                                        Published
                                    </option>

                                    <option value="closed">
                                        Closed
                                    </option>

                                </select>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Start Date
                                </label>

                                <input
                                    type="datetime-local"
                                    name="start_date"
                                    class="form-control"
                                    value="{{ old('start_date') }}">

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    End Date
                                </label>

                                <input
                                    type="datetime-local"
                                    name="end_date"
                                    class="form-control"
                                    value="{{ old('end_date') }}">

                            </div>

                        </div>


                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('super-admin.online-tests.index') }}"
                                class="btn btn-light">

                                Cancel

                            </a>

                            <button
                                type="submit"
                                class="btn btn-dark">

                                <i class="bi bi-check-lg"></i>

                                Create Test

                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold">
                            Test Structure
                        </h5>

                        <hr>

                        <div class="d-flex mb-3">

                            <i class="bi bi-1-circle fs-4 me-3"></i>

                            <div>
                                <strong>Create Test</strong>
                                <p class="text-muted small mb-0">
                                    Basic test information.
                                </p>
                            </div>

                        </div>


                        <div class="d-flex mb-3">

                            <i class="bi bi-2-circle fs-4 me-3"></i>

                            <div>
                                <strong>Add Questions</strong>
                                <p class="text-muted small mb-0">
                                    Add MCQ questions and options.
                                </p>
                            </div>

                        </div>


                        <div class="d-flex mb-3">

                            <i class="bi bi-3-circle fs-4 me-3"></i>

                            <div>
                                <strong>Publish Test</strong>
                                <p class="text-muted small mb-0">
                                    Make test available for students.
                                </p>
                            </div>

                        </div>


                        <div class="alert alert-info">

                            <strong>Note:</strong>

                            Questions can be added after
                            creating the test.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


@endsection
