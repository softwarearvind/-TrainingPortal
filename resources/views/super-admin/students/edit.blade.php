@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')


<div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Edit Student
        </h3>

        <p class="text-muted mb-0">
            Update student profile and course enrollment
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
        action="{{ route('super-admin.students.update', $student) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <div class="row g-4">


            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Student Information
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
                                    value="{{ old('name', $student->user->name) }}"
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
                                    value="{{ old('email', $student->user->email) }}"
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
                                    value="{{ old('admission_no', $student->admission_no) }}"
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
                                    value="{{ old('phone', $student->phone) }}"
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
                                    value="{{ old(
                                        'date_of_birth',
                                        optional($student->date_of_birth)->format('Y-m-d')
                                    ) }}"
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

                                    <option
                                        value="male"
                                        @selected(old('gender', $student->gender) === 'male')
                                    >
                                        Male
                                    </option>

                                    <option
                                        value="female"
                                        @selected(old('gender', $student->gender) === 'female')
                                    >
                                        Female
                                    </option>

                                    <option
                                        value="other"
                                        @selected(old('gender', $student->gender) === 'other')
                                    >
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
                                    value="{{ old('qualification', $student->qualification) }}"
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

                                    <option
                                        value="1"
                                        @selected(old('status', $student->status) == 1)
                                    >
                                        Active
                                    </option>

                                    <option
                                        value="0"
                                        @selected(old('status', $student->status) == 0)
                                    >
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
                                >{{ old('address', $student->address) }}</textarea>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    City
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                    value="{{ old('city', $student->city) }}"
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
                                    value="{{ old('state', $student->state) }}"
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
                                    value="{{ old('pincode', $student->pincode) }}"
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4">


                {{-- IMAGE --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Profile Image
                        </h5>

                    </div>

                    <div class="card-body">

                        @if($student->image)

                            <div class="mb-3">

                                <img
                                    src="{{ asset($student->image) }}"
                                    width="100"
                                    height="100"
                                    class="rounded-circle object-fit-cover"
                                >

                            </div>

                        @endif


                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Leave empty to keep current image.
                        </small>

                    </div>

                </div>


                {{-- COURSES --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Courses
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
                                            old('courses', $studentCourseIds)
                                        )
                                    )
                                >
                                    {{ $course->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


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
                        Update
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
