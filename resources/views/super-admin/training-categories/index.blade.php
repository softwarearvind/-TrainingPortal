@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Training Categories
            </h3>

            <p class="text-muted mb-0">
                Manage your training categories
            </p>

        </div>


        <a
            href="{{ route('super-admin.training-categories.create') }}"
            class="btn btn-dark">

            <i class="bi bi-plus-lg"></i>

            Add Category

        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Image</th>

                            <th>Name</th>

                            <th>Slug</th>

                            <th>Description</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                @if($category->image)

                                    <img
                                        src="{{ asset($category->image) }}"
                                        width="55"
                                        height="55"
                                        style="
                                            object-fit:cover;
                                            border-radius:8px;
                                        ">

                                @else

                                    <div
                                        class="bg-light d-flex
                                               align-items-center
                                               justify-content-center"
                                        style="
                                            width:55px;
                                            height:55px;
                                            border-radius:8px;
                                        ">

                                        <i class="bi bi-book fs-4"></i>

                                    </div>

                                @endif

                            </td>


                            <td>

                                <strong>
                                    {{ $category->name }}
                                </strong>

                            </td>


                            <td>

                                <code>
                                    {{ $category->slug }}
                                </code>

                            </td>


                            <td>

                                {{ Str::limit(
                                    $category->description,
                                    50
                                ) }}

                            </td>


                            <td>

                                @if($category->status)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <td>

                                <a
                                    href="{{ route(
                                        'super-admin.training-categories.edit',
                                        $category
                                    ) }}"
                                    class="btn btn-sm
                                           btn-outline-primary">

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <form
                                    action="{{ route(
                                        'super-admin.training-categories.toggle-status',
                                        $category
                                    ) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-sm
                                               btn-outline-warning">

                                        <i class="bi bi-power"></i>

                                    </button>

                                </form>


                                <form
                                    action="{{ route(
                                        'super-admin.training-categories.destroy',
                                        $category
                                    ) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="
                                        return confirm(
                                            'Delete this category?'
                                        );
                                    ">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm
                                               btn-outline-danger">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5">

                                <i
                                    class="bi bi-folder-x fs-1
                                           text-muted">
                                </i>

                                <p class="text-muted mt-2">
                                    No training categories found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $categories->links() }}

            </div>

        </div>

    </div>

</div>


@endsection
