@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold">
            Generate Certificate
        </h3>

        <p class="text-muted">
            Generate a certificate for a completed student.
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
        action="{{ route('super-admin.certificates.store') }}"
        method="POST">

        @csrf

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label">
                            Student
                        </label>

                        <select
                            name="student_id"
                            class="form-select"
                            required>

                            <option value="">
                                Select Student
                            </option>

                            @foreach($students as $student)

                                <option
                                    value="{{ $student->id }}">

                                    {{ $student->user->name ?? 'Student' }}

                                    -
                                    {{ $student->admission_no }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6">

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

                                <option value="{{ $course->id }}">

                                    {{ $course->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6">

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

                                <option value="{{ $batch->id }}">

                                    {{ $batch->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Certificate Title
                        </label>

                        <input
                            type="text"
                            name="certificate_title"
                            class="form-control"
                            value="Certificate of Completion"
                            required>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Obtained Marks
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="marks"
                            class="form-control">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Total Marks
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="total_marks"
                            class="form-control">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Grade
                        </label>

                        <input
                            type="text"
                            name="grade"
                            class="form-control"
                            placeholder="A+">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Completion Date
                        </label>

                        <input
                            type="date"
                            name="completion_date"
                            class="form-control">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Issue Date
                        </label>

                        <input
                            type="date"
                            name="issue_date"
                            class="form-control"
                            value="{{ date('Y-m-d') }}"
                            required>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="1">
                                Valid
                            </option>

                            <option value="0">
                                Revoked
                            </option>

                        </select>

                    </div>

                </div>


                <hr class="my-4">


                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('super-admin.certificates.index') }}"
                        class="btn btn-light">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="btn btn-dark">

                        <i class="bi bi-award"></i>

                        Generate Certificate

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>


@endsection
