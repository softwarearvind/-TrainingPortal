<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Trainer Login - Training Portal</title>

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
                    rgba(17, 24, 39, .90),
                    rgba(17, 24, 39, .90)
                ),
                url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1600&q=80')
                center/cover no-repeat;

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
            box-shadow: 0 20px 60px rgba(0,0,0,.35);
        }

        .logo {
            width: 70px;
            height: 70px;
            background: #c49a5a;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 32px;
        }

        .btn-login {
            background: #c49a5a;
            border: none;
            color: #fff;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-login:hover {
            background: #a98043;
            color: #fff;
        }

    </style>

</head>

<body>

<div class="login-card">

    <div class="mb-4 text-center">

        <div class="mb-3 logo">
            <i class="bi bi-person-badge"></i>
        </div>

        <h3 class="mb-1 fw-bold">
            Trainer Login
        </h3>

        <p class="text-muted">
            Training Portal
        </p>

    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

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
        action="{{ route('trainer.login.submit') }}"
        method="POST"
    >

        @csrf

        <div class="mb-3">

            <label class="form-label">
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
                    placeholder="trainer@example.com"
                    required
                >

            </div>

        </div>

        <div class="mb-4">

            <label class="form-label">
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
                    placeholder="Enter password"
                    required
                >

            </div>

        </div>

        <button
            type="submit"
            class="btn btn-login w-100"
        >

            <i class="bi bi-box-arrow-in-right me-2"></i>

            Login as Trainer

        </button>

    </form>

    <div class="mt-4 text-center">

        <a
            href="{{ route('home') }}"
            class="text-decoration-none"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Website
        </a>

    </div>

</div>

</body>

</html>
