@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid p-4">


    {{-- Header --}}

    <div class="page-header mb-4">

        <div
            class="d-flex
                   justify-content-between
                   align-items-center
                   flex-wrap
                   gap-3">

            <div>

                <h3 class="mb-1">

                    <i class="bi bi-person-badge me-2"></i>

                    Trainers

                </h3>

                <p class="mb-0 text-white-50">

                    Manage training instructors

                </p>

            </div>


            <a
                href="{{ route(
                    'super-admin.trainers.create'
                ) }}"
                class="btn btn-gold">

                <i class="bi bi-plus-lg me-1"></i>

                Add Trainer

            </a>

        </div>

    </div>


    {{-- Success --}}

    @if(session('success'))

        <div
            class="alert alert-success
                   alert-dismissible
                   fade show">

            <i class="bi bi-check-circle me-1"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Table --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    class="table table-hover
                           align-middle mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th class="px-3">#</th>

                            <th>Trainer</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Specialization</th>

                            <th>Courses</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($trainers as $trainer)

                            <tr>

                                <td class="px-3">

                                    {{
                                        $trainers->firstItem()
                                        + $loop->index
                                    }}

                                </td>


                                {{-- Trainer --}}

                                <td>

                                    <div
                                        class="d-flex
                                               align-items-center
                                               gap-2">

                                        @if($trainer->image)

                                            <img
                                                src="{{ asset(
                                                    $trainer->image
                                                ) }}"
                                                class="trainer-image"
                                                alt="Trainer">

                                        @else

                                            <div class="no-image">

                                                <i
                                                    class="bi bi-person">
                                                </i>

                                            </div>

                                        @endif


                                        <div>

                                            <strong>
                                                {{ $trainer->name }}
                                            </strong>

                                            <br>

                                            <small
                                                class="text-muted">

                                                {{
                                                    $trainer->qualification
                                                    ?: 'Qualification not added'
                                                }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- Email --}}

                                <td>

                                    {{ $trainer->email }}

                                </td>


                                {{-- Phone --}}

                                <td>

                                    {{ $trainer->phone ?: '-' }}

                                </td>


                                {{-- Specialization --}}

                                <td>

                                    {{
                                        $trainer->specialization
                                        ?: '-'
                                    }}

                                </td>


                                {{-- Courses --}}

                                <td>

                                    <span
                                        class="badge bg-primary">

                                        {{
                                            $trainer->courses_count
                                        }}

                                        Courses

                                    </span>

                                </td>


                                {{-- Status --}}

                                <td>

                                    @if($trainer->status)

                                        <span
                                            class="badge bg-success">

                                            Active

                                        </span>

                                    @else

                                        <span
                                            class="badge bg-danger">

                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}

                                <td>

                                    <div
                                        class="d-flex gap-1">


                                        <a
                                            href="{{ route(
                                                'super-admin.trainers.edit',
                                                $trainer
                                            ) }}"
                                            class="btn
                                                   btn-sm
                                                   btn-primary">

                                            <i
                                                class="bi bi-pencil">
                                            </i>

                                        </a>


                                        <form
                                            action="{{ route(
                                                'super-admin.trainers.toggle-status',
                                                $trainer
                                            ) }}"
                                            method="POST">

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn
                                                       btn-sm
                                                       btn-warning">

                                                <i
                                                    class="bi bi-power">
                                                </i>

                                            </button>

                                        </form>


                                        <form
                                            action="{{ route(
                                                'super-admin.trainers.destroy',
                                                $trainer
                                            ) }}"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Delete this trainer?'
                                                );
                                            ">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn
                                                       btn-sm
                                                       btn-danger">

                                                <i
                                                    class="bi bi-trash">
                                                </i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5">

                                    <i
                                        class="bi bi-person-badge
                                               fs-1
                                               text-muted">
                                    </i>

                                    <h5 class="mt-3">

                                        No Trainers Found

                                    </h5>

                                    <p class="text-muted">

                                        Add your first trainer.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <div class="mt-4">

        {{ $trainers->links() }}

    </div>

</div>


@endsection
