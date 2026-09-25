<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Student Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        body {
            min-height: 100vh;
            background:
                linear-gradient(
                    135deg,
                    #111827,
                    #1f2937
                );

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 20px 50px rgba(0,0,0,.25);
        }

        .login-icon {
            width: 75px;
            height: 75px;
            background: #c49a5a;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: auto;
        }

        .btn-login {
            background: #c49a5a;
            border: none;
            color: white;
            padding: 12px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #a77e42;
            color: white;
        }

        .form-control {
            padding: 12px;
        }

    </style>

</head>

<body>

<div class="login-card">

    <div class="mb-4 text-center">

        <div class="mb-3 login-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        <h3 class="mb-1 fw-bold">
            Student Login
        </h3>

        <p class="text-muted">
            Login to access your training portal
        </p>

    </div>


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


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
        action="{{ route('student.login.submit') }}"
        method="POST"
    >

        @csrf


        <div class="mb-3">

            <label class="form-label fw-semibold">
                Email Address
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                >

            </div>

        </div>


        <div class="mb-4">

            <label class="form-label fw-semibold">
                Password
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter your password"
                    required
                >

            </div>

        </div>


        <button
            type="submit"
            class="btn btn-login w-100"
        >
            <i class="bi bi-box-arrow-in-right me-2"></i>
            Login
        </button>

    </form>

</div>

</body>

</html>
