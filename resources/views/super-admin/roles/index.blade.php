@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')
<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Roles & Permissions
            </h3>

            <p class="text-muted mb-0">
                Manage user roles and access permissions
            </p>

        </div>


        <a
            href="{{ route('super-admin.roles.create') }}"
            class="btn btn-dark">

            <i class="bi bi-plus-lg"></i>

            Create Role

        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <div class="row g-4">

        @forelse($roles as $role)

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h5>
                                    {{ $role->name }}
                                </h5>

                                <small class="text-muted">

                                    {{ $role->users_count }}
                                    Users

                                </small>

                            </div>


                            <div>

                                <a
                                    href="{{ route('super-admin.roles.edit', $role) }}"
                                    class="btn btn-sm btn-outline-primary">

                                    <i class="bi bi-pencil"></i>

                                </a>

                            </div>

                        </div>


                        <hr>


                        <h6>
                            Permissions
                        </h6>


                        <div>

                            @forelse($role->permissions as $permission)

                                <span
                                    class="badge bg-light text-dark border mb-1">

                                    {{ $permission->name }}

                                </span>

                            @empty

                                <span class="text-muted">
                                    No permissions
                                </span>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info">

                    No roles found.

                </div>

            </div>

        @endforelse

    </div>

</div>



@endsection
