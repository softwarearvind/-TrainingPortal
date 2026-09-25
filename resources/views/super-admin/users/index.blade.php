@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Users
            </h3>

            <p class="text-muted mb-0">
                Manage all system users
            </p>

        </div>

        <a
            href="{{ route('super-admin.users.create') }}"
            class="btn btn-dark">

            <i class="bi bi-plus-lg"></i>

            Add User

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

                            <th>User</th>

                            <th>Email</th>

                            <th>Role</th>

                            <th>Status</th>

                            <th>Created</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                <strong>
                                    {{ $user->name }}
                                </strong>

                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>

                                @forelse($user->roles as $role)

                                    <span class="badge bg-primary">
                                        {{ $role->name }}
                                    </span>

                                @empty

                                    <span class="text-muted">
                                        No Role
                                    </span>

                                @endforelse

                            </td>

                            <td>

                                @if($user->status)

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
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('super-admin.users.edit', $user) }}"
                                    class="btn btn-sm btn-outline-primary">

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <form
                                    action="{{ route('super-admin.users.toggle-status', $user) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-warning">

                                        <i class="bi bi-power"></i>

                                    </button>

                                </form>


                                <form
                                    action="{{ route('super-admin.users.destroy', $user) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Delete this user?');">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-4">

                                No users found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $users->links() }}

            </div>

        </div>

    </div>

</div>







    </div>

    <!-- USERS + ACTIVITY -->


@endsection
