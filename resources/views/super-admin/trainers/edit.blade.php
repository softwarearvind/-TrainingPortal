@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container py-5">

    <div class="card form-card shadow">


        <div class="header">

            <h4 class="mb-1">

                <i class="bi bi-pencil-square me-2"></i>

                Edit Trainer

            </h4>

            <small class="text-white-50">

                Update trainer profile and courses

            </small>

        </div>


        <div class="card-body p-4">


            @if($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Please fix these errors:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route(
                    'super-admin.trainers.update',
                    $trainer
                ) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                @method('PUT')


                <div class="row g-4">


                    {{-- Name --}}

                    <div class="col-md-6">

                        <label class="form-label">

                            Trainer Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old(
                                'name',
                                $trainer->name
                            ) }}"
                            class="form-control"
                            required>

                    </div>


                    {{-- Email --}}

                    <div class="col-md-6">

                        <label class="form-label">

                            Email
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old(
                                'email',
                                $trainer->email
                            ) }}"
                            class="form-control"
                            required>

                    </div>


                    {{-- Phone --}}

                    <div class="col-md-4">

                        <label class="form-label">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old(
                                'phone',
                                $trainer->phone
                            ) }}"
                            class="form-control">

                    </div>


                    {{-- Qualification --}}

                    <div class="col-md-4">

                        <label class="form-label">
                            Qualification
                        </label>

                        <input
                            type="text"
                            name="qualification"
                            value="{{ old(
                                'qualification',
                                $trainer->qualification
                            ) }}"
                            class="form-control">

                    </div>


                    {{-- Experience --}}

                    <div class="col-md-4">

                        <label class="form-label">
                            Experience
                        </label>

                        <input
                            type="text"
                            name="experience"
                            value="{{ old(
                                'experience',
                                $trainer->experience
                            ) }}"
                            class="form-control">

                    </div>


                    {{-- Specialization --}}

                    <div class="col-md-8">

                        <label class="form-label">
                            Specialization
                        </label>

                        <input
                            type="text"
                            name="specialization"
                            value="{{ old(
                                'specialization',
                                $trainer->specialization
                            ) }}"
                            class="form-control">

                    </div>


                    {{-- Status --}}

                    <div class="col-md-4">

                        <label class="form-label">

                            Status
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option
                                value="1"
                                {{ old(
                                    'status',
                                    $trainer->status
                                ) == 1
                                    ? 'selected'
                                    : '' }}>

                                Active

                            </option>

                            <option
                                value="0"
                                {{ old(
                                    'status',
                                    $trainer->status
                                ) == 0
                                    ? 'selected'
                                    : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>


                    {{-- Image --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Profile Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp">


                        @if($trainer->image)

                            <div class="mt-3">

                                <small class="d-block mb-2">
                                    Current Image
                                </small>

                                <img
                                    src="{{ asset(
                                        $trainer->image
                                    ) }}"
                                    class="current-image">

                            </div>

                        @endif

                    </div>


                    {{-- Courses --}}

                    <div class="col-md-6">

                        <label class="form-label">

                            Assign Courses

                        </label>


                        <select
                            name="courses[]"
                            class="form-select"
                            multiple
                            size="5">

                            @foreach($courses as $course)

                                <option
                                    value="{{ $course->id }}"
                                    {{ in_array(
                                        $course->id,
                                        old(
                                            'courses',
                                            $trainerCourseIds
                                        )
                                    )
                                    ? 'selected'
                                    : '' }}>

                                    {{ $course->name }}

                                </option>

                            @endforeach

                        </select>


                        <small class="text-muted">

                            Hold Ctrl to select multiple courses.

                        </small>

                    </div>


                    {{-- Bio --}}

                    <div class="col-12">

                        <label class="form-label">
                            Bio
                        </label>

                        <textarea
                            name="bio"
                            rows="5"
                            class="form-control">{{ old(
                                'bio',
                                $trainer->bio
                            ) }}</textarea>

                    </div>

                </div>


                <hr class="my-4">


                <div
                    class="d-flex
                           justify-content-between">

                    <a
                        href="{{ route(
                            'super-admin.trainers.index'
                        ) }}"
                        class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>

                        Back

                    </a>


                    <button
                        type="submit"
                        class="btn btn-gold px-4">

                        <i class="bi bi-check-lg"></i>

                        Update Trainer

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


@endsection
