@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')
<div class="container py-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h4 class="mb-4">
                Edit Role
            </h4>


            @if($errors->any())

                <div class="alert alert-danger">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('super-admin.roles.update', $role) }}">

                @csrf

                @method('PUT')


                <div class="mb-4">

                    <label class="form-label">
                        Role Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $role->name) }}"
                        class="form-control"
                        required>

                </div>


                <h5 class="mb-3">
                    Permissions
                </h5>


                <div class="row">

                    @foreach($permissions as $permission)

                        <div class="col-md-4 mb-3">

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->name }}"
                                    id="permission{{ $permission->id }}"

                                    @checked(
                                        in_array(
                                            $permission->name,
                                            $rolePermissions
                                        )
                                    )
                                >

                                <label
                                    class="form-check-label"
                                    for="permission{{ $permission->id }}">

                                    {{ $permission->name }}

                                </label>

                            </div>

                        </div>

                    @endforeach

                </div>


                <button
                    type="submit"
                    class="btn btn-dark">

                    Update Role

                </button>


                <a
                    href="{{ route('super-admin.roles.index') }}"
                    class="btn btn-light">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>



@endsection
