@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container py-5">

    <div class="card form-card shadow">

        <div class="header">

            <h4 class="mb-1">

                <i class="bi bi-plus-circle"></i>

                Add New Course

            </h4>

            <small class="text-white-50">
                Create a new training course
            </small>

        </div>


        <div class="card-body p-4">

            @if($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Please fix the following errors:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('super-admin.courses.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="row g-4">


                    {{-- Category --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Training Category
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                            required>

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Course Name --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Course Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control"
                            placeholder="e.g. Laravel 13 Development"
                            required>

                    </div>


                    {{-- Training Mode --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Training Mode
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="training_mode"
                            class="form-select"
                            required>

                            <option value="online"
                                {{ old('training_mode') === 'online'
                                    ? 'selected'
                                    : '' }}>

                                Online

                            </option>

                            <option value="offline"
                                {{ old('training_mode') === 'offline'
                                    ? 'selected'
                                    : '' }}>

                                Offline

                            </option>

                            <option value="hybrid"
                                {{ old('training_mode') === 'hybrid'
                                    ? 'selected'
                                    : '' }}>

                                Hybrid

                            </option>

                        </select>

                    </div>


                    {{-- Duration --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Duration
                        </label>

                        <input
                            type="text"
                            name="duration"
                            value="{{ old('duration') }}"
                            class="form-control"
                            placeholder="e.g. 3 Months">

                    </div>


                    {{-- Fee --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Course Fee
                            <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₹
                            </span>

                            <input
                                type="number"
                                name="fee"
                                value="{{ old('fee', 0) }}"
                                class="form-control"
                                min="0"
                                step="0.01"
                                required>

                        </div>

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

                            <option value="1"
                                {{ old('status', 1) == 1
                                    ? 'selected'
                                    : '' }}>

                                Active

                            </option>

                            <option value="0"
                                {{ old('status') === '0'
                                    ? 'selected'
                                    : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>


                    {{-- Image --}}
                    <div class="col-md-8">

                        <label class="form-label">
                            Course Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp">

                        <small class="text-muted">
                            JPG, JPEG, PNG, WEBP — Max 2MB
                        </small>

                    </div>


                    {{-- Description --}}
                    <div class="col-12">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="form-control"
                            placeholder="Enter course description...">{{ old('description') }}</textarea>

                    </div>


                </div>


                <hr class="my-4">


                <div class="d-flex
                            justify-content-between">

                    <a
                        href="{{ route(
                            'super-admin.courses.index'
                        ) }}"
                        class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>

                        Back

                    </a>


                    <button
                        type="submit"
                        class="btn btn-gold px-4">

                        <i class="bi bi-check-lg"></i>

                        Create Course

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@endsection
