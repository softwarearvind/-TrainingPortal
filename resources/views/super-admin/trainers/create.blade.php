@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')


<div class="container py-5">

    <div class="card form-card shadow">


        <div class="header">

            <h4 class="mb-1">

                <i class="bi bi-person-plus me-2"></i>

                Add New Trainer

            </h4>

            <small class="text-white-50">

                Create trainer profile and assign courses

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
                    'super-admin.trainers.store'
                ) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


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
                            value="{{ old('name') }}"
                            class="form-control"
                            placeholder="Enter trainer name"
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
                            value="{{ old('email') }}"
                            class="form-control"
                            placeholder="trainer@example.com"
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
                            value="{{ old('phone') }}"
                            class="form-control"
                            placeholder="9876543210">

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
                                'qualification'
                            ) }}"
                            class="form-control"
                            placeholder="B.Tech / MCA / MBA">

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
                                'experience'
                            ) }}"
                            class="form-control"
                            placeholder="5 Years">

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
                                'specialization'
                            ) }}"
                            class="form-control"
                            placeholder="Laravel, PHP, MySQL">

                    </div>


                    {{-- Status --}}

                    <div class="col-md-4">

                        <label class="form-label">
                            Status
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required>

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
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

                        <small class="text-muted">
                            Maximum 2MB
                        </small>

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
                                        old('courses', [])
                                    ) ? 'selected' : '' }}>

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
                            class="form-control"
                            placeholder="Enter trainer profile...">{{ old('bio') }}</textarea>

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

                        Create Trainer

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


@endsection
