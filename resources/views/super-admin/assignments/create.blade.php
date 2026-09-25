@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid p-4">


    <div class="page-header mb-4">

        <h3 class="mb-1">

            <i class="bi bi-clipboard-plus"></i>

            Add Assignment

        </h3>

        <small>
            Create an assignment for a batch
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
        action="{{ route('super-admin.assignments.store') }}"
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
                            Assignment Information
                        </h5>


                        <div class="row">


                            <div class="col-md-6 mb-3">

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


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Batch *
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
                                            {{ old('batch_id') == $batch->id ? 'selected' : '' }}
                                        >

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
                                Assignment Title *
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ old('title') }}"
                                placeholder="Example: Laravel CRUD Project"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="4"
                                placeholder="Assignment description..."
                            >{{ old('description') }}</textarea>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Instructions
                            </label>

                            <textarea
                                name="instructions"
                                class="form-control"
                                rows="6"
                                placeholder="Explain what students need to do..."
                            >{{ old('instructions') }}</textarea>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Assignment Attachment
                            </label>

                            <input
                                type="file"
                                name="attachment"
                                class="form-control"
                                accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip"
                            >

                            <small class="text-muted">

                                PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, ZIP.
                                Maximum 20MB.

                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Settings --}}

            <div class="col-lg-4">

                <div class="card">

                    <div class="card-body p-4">

                        <h5 class="section-title">
                            Assignment Settings
                        </h5>


                        <div class="mb-3">

                            <label class="form-label">
                                Total Marks *
                            </label>

                            <input
                                type="number"
                                name="total_marks"
                                class="form-control"
                                value="{{ old('total_marks', 100) }}"
                                min="0"
                                step="0.01"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Start Date
                            </label>

                            <input
                                type="datetime-local"
                                name="start_date"
                                class="form-control"
                                value="{{ old('start_date') }}"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Due Date
                            </label>

                            <input
                                type="datetime-local"
                                name="due_date"
                                class="form-control"
                                value="{{ old('due_date') }}"
                            >

                        </div>


                        <div class="form-check mb-3">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="allow_late_submission"
                                value="1"
                                id="allow_late_submission"
                                {{ old('allow_late_submission') ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="allow_late_submission"
                            >

                                Allow Late Submission

                            </label>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Late Penalty (%)
                            </label>

                            <input
                                type="number"
                                name="late_penalty"
                                class="form-control"
                                value="{{ old('late_penalty', 0) }}"
                                min="0"
                                max="100"
                                step="0.01"
                            >

                            <small class="text-muted">
                                Percentage deducted for late submission.
                            </small>

                        </div>


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

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                            >

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


                        <div class="alert alert-info">

                            <i class="bi bi-info-circle"></i>

                            <strong>Assignment Status</strong>

                            <ul class="mb-0 mt-2">

                                <li>Draft — not visible to students</li>

                                <li>Published — available to students</li>

                                <li>Closed — submissions closed</li>

                            </ul>

                        </div>


                        <div class="d-grid gap-2">

                            <button
                                type="submit"
                                class="btn btn-gold"
                            >

                                <i class="bi bi-check-lg"></i>

                                Save Assignment

                            </button>


                            <a
                                href="{{ route('super-admin.assignments.index') }}"
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


@endsection
