@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')
<div class="container py-5">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h4 class="mb-0">
                Add Training Category
            </h4>

        </div>


        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route(
                    'super-admin.training-categories.store'
                ) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="row g-3">


                    <div class="col-md-6">

                        <label class="form-label">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control"
                            placeholder="Example: Software Training"
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
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>


                    <div class="col-12">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="form-control"
                            placeholder="Enter category description">{{ old('description') }}</textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Category Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/*">

                        <small class="text-muted">
                            JPG, PNG, WEBP — Max 2MB
                        </small>

                    </div>

                </div>


                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-dark">

                        <i class="bi bi-check-lg"></i>

                        Create Category

                    </button>


                    <a
                        href="{{ route(
                            'super-admin.training-categories.index'
                        ) }}"
                        class="btn btn-light">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>



@endsection
