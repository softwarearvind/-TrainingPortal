<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'Student Dashboard')</title>

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
            color: white;
            padding: 20px 15px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-brand {
            padding: 15px;
            border-bottom: 1px solid #374151;
            margin-bottom: 20px;
        }

        .sidebar-brand i {
            color: #c49a5a;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d1d5db;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #c49a5a;
            color: white;
        }

        .main {
            margin-left: 260px;
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .content {
            padding: 30px;
        }

        .welcome-card {
            background: linear-gradient(
                135deg,
                #111827,
                #374151
            );
            color: white;
            border-radius: 16px;
            padding: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 22px;
            border: 1px solid #e5e7eb;
            height: 100%;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #f3e8d5;
            color: #a77e42;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .course-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            height: 100%;
        }

        .course-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #111827;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media(max-width: 768px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .content {
                padding: 15px;
            }

            .topbar {
                padding: 0 15px;
            }

        }

    </style>

    @stack('styles')

</head>

<body>

@include('partials.student-sidebar')

<div class="main">

    @include('partials.student-topbar')

    <div class="content">
        @yield('content')
    </div>

</div>

@stack('scripts')

</body>

</html>
