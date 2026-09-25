<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Trainer Dashboard</title>

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
            background: #f5f7fb;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #111827;
            color: #fff;
            padding: 25px 15px;
        }

        .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
}

        .sidebar-brand {
            padding: 10px;
            margin-bottom: 25px;
        }

        .sidebar a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #c49a5a;
            color: #fff;
        }

        .main {
            margin-left: 260px;
            padding: 30px;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            padding: 25px;
        }

        .course-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.06);
        }

    </style>

</head>

<body>

<div class="sidebar">

    <div class="sidebar-brand">

        <h5>
            <i class="bi bi-mortarboard-fill me-2"></i>
            Training Portal
        </h5>

        <small class="text-secondary">
            Trainer Panel
        </small>

    </div>

    <a
        href="{{ route('trainer.dashboard') }}"
        class="active"
    >
        <i class="bi bi-speedometer2 me-2"></i>
        Dashboard
    </a>

    <a href="#">
        <i class="bi bi-book me-2"></i>
        My Courses
    </a>

    <a href="#">
        <i class="bi bi-collection me-2"></i>
        My Batches
    </a>

    <a href="#">
        <i class="bi bi-camera-video me-2"></i>
        Training Sessions
    </a>

    <a href="#">
        <i class="bi bi-play-circle me-2"></i>
        Videos
    </a>

    <a href="#">
        <i class="bi bi-clipboard-check me-2"></i>
        Assignments
    </a>

    <a href="#">
        <i class="bi bi-ui-checks-grid me-2"></i>
        Online Tests
    </a>

    <a href="#">
        <i class="bi bi-calendar-check me-2"></i>
        Attendance
    </a>

    <a href="#">
        <i class="bi bi-bar-chart me-2"></i>
        Results
    </a>

    <hr>

    <form
        action="{{ route('trainer.logout') }}"
        method="POST"
    >

        @csrf

        <button
            type="submit"
            class="btn btn-outline-light w-100"
        >
            <i class="bi bi-box-arrow-right me-2"></i>
            Logout
        </button>

    </form>

</div>

<div class="main">

    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold">
                Trainer Dashboard
            </h2>

            <p class="mb-0 text-muted">
                Welcome, {{ $user->name }}
            </p>

        </div>

        <div>
            <span class="p-2 badge bg-dark">
                Trainer
            </span>
        </div>

    </div>

    <div class="mb-4 row g-4">

        <div class="col-md-4">

            <div class="shadow-sm card stat-card">

                <div class="d-flex justify-content-between">

                    <div>
                        <small class="text-muted">
                            My Courses
                        </small>

                        <h2 class="mt-2 fw-bold">
                            {{ $courses->count() }}
                        </h2>
                    </div>

                    <i class="bi bi-book fs-1 text-secondary"></i>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="shadow-sm card stat-card">

                <div class="d-flex justify-content-between">

                    <div>
                        <small class="text-muted">
                            Trainer
                        </small>

                        <h5 class="mt-2 fw-bold">
                            {{ $trainer->name }}
                        </h5>
                    </div>

                    <i class="bi bi-person-badge fs-1 text-secondary"></i>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="shadow-sm card stat-card">

                <div class="d-flex justify-content-between">

                    <div>
                        <small class="text-muted">
                            Specialization
                        </small>

                        <h6 class="mt-2 fw-bold">
                            {{ $trainer->specialization ?? 'Not Added' }}
                        </h6>
                    </div>

                    <i class="bi bi-award fs-1 text-secondary"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="card course-card">

        <div class="p-4 card-body">

            <h4 class="mb-4 fw-bold">
                My Courses
            </h4>

            <div class="row g-3">

                @forelse($courses as $course)

                    <div class="col-md-6 col-lg-4">

                        <div class="p-3 border rounded h-100">

                            <h5 class="fw-bold">
                                {{ $course->name }}
                            </h5>

                            <p class="text-muted small">
                                {{ $course->description
                                    ? Str::limit($course->description, 100)
                                    : 'No description available.'
                                }}
                            </p>

                            <span class="badge bg-dark">
                                {{ ucfirst($course->training_mode) }}
                            </span>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="alert alert-info">
                            No courses assigned to you yet.
                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

</body>

</html>
