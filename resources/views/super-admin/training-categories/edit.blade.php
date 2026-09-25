@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')
<div class="container py-5">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h4 class="mb-0">
                Edit Training Category
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
                    'super-admin.training-categories.update',
                    $trainingCategory
                ) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                @method('PUT')


                <div class="row g-3">


                    <div class="col-md-6">

                        <label class="form-label">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old(
                                'name',
                                $trainingCategory->name
                            ) }}"
                            class="form-control"
                            required>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option
                                value="1"
                                @selected($trainingCategory->status)>
                                Active
                            </option>

                            <option
                                value="0"
                                @selected(!$trainingCategory->status)>
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
                            class="form-control">{{ old(
                                'description',
                                $trainingCategory->description
                            ) }}</textarea>

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

                    </div>


                    @if($trainingCategory->image)

                        <div class="col-md-6">

                            <label class="form-label d-block">
                                Current Image
                            </label>

                            <img
                                src="{{ asset(
                                    $trainingCategory->image
                                ) }}"
                                width="100"
                                height="100"
                                style="
                                    object-fit:cover;
                                    border-radius:10px;
                                ">

                        </div>

                    @endif

                </div>


                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-dark">

                        Update Category

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
