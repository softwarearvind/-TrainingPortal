<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Super Admin Dashboard')</title>

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
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #111827;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px 15px;
            color: white;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .logo {
            font-size: 21px;
            font-weight: 700;
            padding: 10px 12px 25px;
            border-bottom: 1px solid #374151;
            margin-bottom: 20px;
        }

        .logo i {
            color: #c49a5a;
        }

        .menu-title {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            margin: 20px 12px 8px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d1d5db;
            text-decoration: none;
            padding: 11px 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #c49a5a;
            color: white;
        }

        .sidebar a i {
            font-size: 17px;
        }

        .main {
            margin-left: 260px;
            min-height: 100vh;
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

        .page-title {
            font-size: 21px;
            font-weight: 600;
            color: #111827;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #c49a5a;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content {
            padding: 30px;
        }

        .welcome {
            background: linear-gradient(135deg, #111827, #273449);
            color: white;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .welcome h3 {
            margin-bottom: 8px;
        }

        .stat-card {
            background: white;
            border: none;
            border-radius: 14px;
            padding: 20px;
            height: 100%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            background: #f3f4f6;
            color: #c49a5a;
        }

        .stat-number {
            font-size: 27px;
            font-weight: 700;
            margin-top: 15px;
            color: #111827;
        }

        .stat-label {
            color: #6b7280;
            font-size: 14px;
        }

        .dashboard-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .dashboard-card h5 {
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .table th {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
        }

        .table td {
            vertical-align: middle;
            font-size: 14px;
        }

        .badge-online {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-offline {
            background: #fee2e2;
            color: #dc2626;
        }

        .quick-btn {
            text-decoration: none;
            color: #111827;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 15px;
            display: block;
            text-align: center;
            transition: .2s;
        }

        .quick-btn:hover {
            border-color: #c49a5a;
            color: #c49a5a;
        }

        .quick-btn i {
            display: block;
            font-size: 25px;
            margin-bottom: 8px;
        }

        @media(max-width: 991px) {
            .sidebar { width: 220px; }
            .main { margin-left: 220px; }
        }

        @media(max-width: 768px) {
            .sidebar { position: relative; width: 100%; min-height: auto; }
            .main { margin-left: 0; }
            .topbar { padding: 0 15px; }
            .content { padding: 15px; }
        }

         .page-header {
            background: #111827;
            color: white;
            border-radius: 15px;
            padding: 25px;
        }

        .btn-gold {
            background: #c49a5a;
            color: white;
            border: none;
        }

        .btn-gold:hover {
            background: #a98248;
            color: white;
        }

        .course-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .course-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .no-image {
            width: 80px;
            height: 60px;
            background: #e5e7eb;
            border-radius: 8px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #6b7280;
            font-size: 24px;
        }


        .form-card {
            max-width: 950px;
            margin: auto;
            border: none;
            border-radius: 15px;
        }

        .header {
            background: #111827;
            color: white;
            padding: 22px;
            border-radius: 15px 15px 0 0;
        }

        .btn-gold {
            background: #c49a5a;
            color: white;
            border: none;
        }

        .btn-gold:hover {
            background: #a98248;
            color: white;
        }

         .page-header {
            background: #111827;
            color: white;
            border-radius: 15px;
            padding: 25px;
        }

        .btn-gold {
            background: #c49a5a;
            color: white;
            border: none;
        }

        .btn-gold:hover {
            background: #a98248;
            color: white;
        }

        .trainer-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .no-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #6b7280;
            font-size: 25px;
        }

        .table th {
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

         .page-header {
            background: #111827;
            color: white;
            padding: 20px;
            border-radius: 12px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
        }

        .btn-gold {
            background: #c49a5a;
            color: white;
        }

        .btn-gold:hover {
            background: #a98247;
            color: white;
        }

        .video-thumb {
            width: 90px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
        }

        .video-icon {
            width: 90px;
            height: 55px;
            background: #111827;
            color: #c49a5a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

          .page-header {
            background: #111827;
            color: white;
            padding: 20px;
            border-radius: 12px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
        }

        .btn-gold {
            background: #c49a5a;
            color: white;
        }

        .btn-gold:hover {
            background: #a98247;
            color: white;
        }

        .section-title {
            color: #111827;
            font-weight: 600;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>

    @stack('styles')
</head>

<body>

    @include('partials.superadmin.sidebar')

    <div class="main">

        @include('partials.superadmin.topbar')

        <div class="content">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
