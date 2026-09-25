@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')
<div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Add Student
        </h3>

        <p class="text-muted mb-0">
            Create student account and profile
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
        action="{{ route('super-admin.students.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="row g-4">


            {{-- BASIC INFORMATION --}}

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-person me-2"></i>
                            Basic Information
                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Confirm Password
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Admission No.
                                </label>

                                <input
                                    type="text"
                                    name="admission_no"
                                    class="form-control"
                                    value="{{ old('admission_no') }}"
                                    placeholder="ADM-2026-001"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone') }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Date of Birth
                                </label>

                                <input
                                    type="date"
                                    name="date_of_birth"
                                    class="form-control"
                                    value="{{ old('date_of_birth') }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Gender
                                </label>

                                <select
                                    name="gender"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option value="male">
                                        Male
                                    </option>

                                    <option value="female">
                                        Female
                                    </option>

                                    <option value="other">
                                        Other
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Qualification
                                </label>

                                <input
                                    type="text"
                                    name="qualification"
                                    class="form-control"
                                    value="{{ old('qualification') }}"
                                    placeholder="BCA / B.Tech / MBA"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    class="form-select"
                                >

                                    <option value="1">
                                        Active
                                    </option>

                                    <option value="0">
                                        Inactive
                                    </option>

                                </select>

                            </div>


                            <div class="col-12">

                                <label class="form-label">
                                    Address
                                </label>

                                <textarea
                                    name="address"
                                    class="form-control"
                                    rows="3"
                                >{{ old('address') }}</textarea>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    City
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                    value="{{ old('city') }}"
                                >

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    State
                                </label>

                                <input
                                    type="text"
                                    name="state"
                                    class="form-control"
                                    value="{{ old('state') }}"
                                >

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Pincode
                                </label>

                                <input
                                    type="text"
                                    name="pincode"
                                    class="form-control"
                                    value="{{ old('pincode') }}"
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- SIDE INFORMATION --}}

            <div class="col-lg-4">


                {{-- IMAGE --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Profile Image
                        </h5>

                    </div>

                    <div class="card-body">

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            JPG, JPEG, PNG or WEBP. Max 2MB.
                        </small>

                    </div>

                </div>


                {{-- COURSES --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Enroll Courses
                        </h5>

                    </div>

                    <div class="card-body">

                        <select
                            name="courses[]"
                            class="form-select"
                            multiple
                            size="7"
                        >

                            @foreach($courses as $course)

                                <option
                                    value="{{ $course->id }}"
                                    @selected(
                                        in_array(
                                            $course->id,
                                            old('courses', [])
                                        )
                                    )
                                >
                                    {{ $course->name }}
                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">
                            Hold Ctrl to select multiple courses.
                        </small>

                    </div>

                </div>


                {{-- BUTTONS --}}

                <div class="d-flex gap-2">

                    <a
                        href="{{ route('super-admin.students.index') }}"
                        class="btn btn-light w-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary w-50"
                    >
                        <i class="bi bi-check-lg"></i>
                        Save Student
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>



@endsection
