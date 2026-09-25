@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <form
    action="{{ route('super-admin.assignments.update', $assignment) }}"
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
                    {{ old('course_id', $assignment->course_id) == $course->id ? 'selected' : '' }}
                >

                    {{ $course->name }}

                </option>

            @endforeach

        </select>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Batch *
        </label>

        <select
            name="batch_id"
            class="form-select"
            required
        >

            @foreach($batches as $batch)

                <option
                    value="{{ $batch->id }}"
                    {{ old('batch_id', $assignment->batch_id) == $batch->id ? 'selected' : '' }}
                >

                    {{ $batch->name }}

                    -
                    {{ $batch->course->name ?? '' }}

                </option>

            @endforeach

        </select>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Assignment Title *
        </label>

        <input
            type="text"
            name="title"
            class="form-control"
            value="{{ old('title', $assignment->title) }}"
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
        >{{ old('description', $assignment->description) }}</textarea>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Instructions
        </label>

        <textarea
            name="instructions"
            class="form-control"
            rows="6"
        >{{ old('instructions', $assignment->instructions) }}</textarea>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Replace Attachment
        </label>

        <input
            type="file"
            name="attachment"
            class="form-control"
            accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip"
        >

        @if($assignment->attachment)

            <small class="text-success">

                Current file:
                {{ $assignment->attachment_name }}

                ({{ $assignment->attachment_size }})

            </small>

        @endif

    </div>


    <div class="mb-3">

        <label class="form-label">
            Total Marks *
        </label>

        <input
            type="number"
            name="total_marks"
            class="form-control"
            value="{{ old('total_marks', $assignment->total_marks) }}"
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
            value="{{ old(
                'start_date',
                $assignment->start_date
                    ? $assignment->start_date->format('Y-m-d\TH:i')
                    : ''
            ) }}"
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
            value="{{ old(
                'due_date',
                $assignment->due_date
                    ? $assignment->due_date->format('Y-m-d\TH:i')
                    : ''
            ) }}"
        >

    </div>


    <div class="form-check mb-3">

        <input
            class="form-check-input"
            type="checkbox"
            name="allow_late_submission"
            value="1"
            id="allow_late_submission"
            {{ old(
                'allow_late_submission',
                $assignment->allow_late_submission
            ) ? 'checked' : '' }}
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
            value="{{ old(
                'late_penalty',
                $assignment->late_penalty
            ) }}"
            min="0"
            max="100"
            step="0.01"
        >

    </div>


    <div class="mb-3">

        <label class="form-label">
            Sort Order
        </label>

        <input
            type="number"
            name="sort_order"
            class="form-control"
            value="{{ old(
                'sort_order',
                $assignment->sort_order
            ) }}"
            min="0"
        >

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
                value="draft"
                {{ old('status', $assignment->status) === 'draft' ? 'selected' : '' }}
            >
                Draft
            </option>

            <option
                value="published"
                {{ old('status', $assignment->status) === 'published' ? 'selected' : '' }}
            >
                Published
            </option>

            <option
                value="closed"
                {{ old('status', $assignment->status) === 'closed' ? 'selected' : '' }}
            >
                Closed
            </option>

        </select>

    </div>


    <button
        type="submit"
        class="btn btn-primary"
    >

        <i class="bi bi-check-lg"></i>

        Update Assignment

    </button>

</form>


@endsection
