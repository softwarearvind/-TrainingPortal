<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Training Portal - Learn. Grow. Succeed.')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        :root {
            --primary: #c49a5a;
            --dark: #111827;
            --dark-2: #1f2937;
            --light: #f8fafc;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #ffffff;
            color: #111827;
        }

        /* =========================
           NAVBAR
        ========================= */

        .main-navbar {
            background: #ffffff;
            box-shadow: 0 3px 20px rgba(0,0,0,0.07);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 800;
            color: var(--dark) !important;
        }

        .navbar-brand span {
            color: var(--primary);
        }

        .navbar-brand i {
            color: var(--primary);
        }

        .nav-link {
            font-weight: 600;
            color: #374151 !important;
            margin: 0 7px;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .btn-login {
            border: 1px solid var(--dark);
            color: var(--dark);
            font-weight: 600;
            padding: 9px 20px;
            border-radius: 8px;
        }

        .btn-login:hover {
            background: var(--dark);
            color: white;
        }

        .btn-enroll {
            background: var(--primary);
            color: white;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 8px;
            border: none;
        }

        .btn-enroll:hover {
            background: #a98147;
            color: white;
        }

        /* =========================
           HERO
        ========================= */

        .hero-section {
            position: relative;
        }

        .hero-slide {
            min-height: 620px;
            background:
                linear-gradient(
                    rgba(17,24,39,0.78),
                    rgba(17,24,39,0.72)
                ),
                url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1800&q=85')
                center/cover;
            display: flex;
            align-items: center;
        }

        .hero-slide.slide-two {
            background:
                linear-gradient(
                    rgba(17,24,39,0.78),
                    rgba(17,24,39,0.72)
                ),
                url('https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1800&q=85')
                center/cover;
        }

        .hero-slide.slide-three {
            background:
                linear-gradient(
                    rgba(17,24,39,0.78),
                    rgba(17,24,39,0.72)
                ),
                url('https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1800&q=85')
                center/cover;
        }

        .hero-content {
            max-width: 760px;
            color: white;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(196,154,90,0.2);
            border: 1px solid rgba(196,154,90,0.7);
            color: #f1d19d;
            padding: 8px 16px;
            border-radius: 30px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .hero-content h1 {
            font-size: 58px;
            font-weight: 800;
            line-height: 1.12;
        }

        .hero-content h1 span {
            color: var(--primary);
        }

        .hero-content p {
            font-size: 19px;
            color: #e5e7eb;
            line-height: 1.8;
            margin: 25px 0;
        }

        .hero-btn {
            padding: 13px 28px;
            border-radius: 8px;
            font-weight: 700;
        }

        .btn-outline-light-custom {
            border: 1px solid white;
            color: white;
            padding: 13px 28px;
            border-radius: 8px;
            font-weight: 700;
        }

        .btn-outline-light-custom:hover {
            background: white;
            color: var(--dark);
        }

        /* =========================
           SECTION
        ========================= */

        .section-padding {
            padding: 90px 0;
        }

        .section-title {
            max-width: 700px;
            margin: auto;
            text-align: center;
        }

        .section-title span {
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title h2 {
            font-size: 38px;
            font-weight: 800;
            margin-top: 10px;
        }

        .section-title p {
            color: #6b7280;
            margin-top: 15px;
        }

        /* =========================
           STATS
        ========================= */

        .stats-section {
            margin-top: -55px;
            position: relative;
            z-index: 5;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 35px rgba(0,0,0,0.10);
            padding: 30px;
            text-align: center;
            height: 100%;
        }

        .stats-card i {
            font-size: 35px;
            color: var(--primary);
        }

        .stats-card h3 {
            font-size: 32px;
            font-weight: 800;
            margin-top: 12px;
        }

        .stats-card p {
            color: #6b7280;
            margin: 0;
        }

        /* =========================
           CATEGORY
        ========================= */

        .category-card {
            border: 1px solid #e5e7eb;
            border-radius: 15px;
            padding: 35px 25px;
            text-align: center;
            height: 100%;
            transition: 0.3s;
        }

        .category-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.09);
        }

        .category-icon {
            width: 75px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            border-radius: 50%;
            background: #fff8ec;
            color: var(--primary);
            font-size: 32px;
        }

        .category-card h5 {
            font-weight: 700;
            margin-top: 20px;
        }

        .category-card p {
            color: #6b7280;
        }

        /* =========================
           COURSE
        ========================= */

        .course-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: white;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            height: 100%;
            transition: 0.3s;
        }

        .course-card:hover {
            transform: translateY(-7px);
        }

        .course-image {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }

        .course-body {
            padding: 22px;
        }

        .course-category {
            display: inline-block;
            background: #fff5e5;
            color: #9a6d2d;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .course-body h5 {
            font-weight: 800;
            margin: 14px 0 10px;
        }

        .course-body p {
            color: #6b7280;
        }

        .course-info {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
            margin-top: 15px;
        }

        .course-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark);
        }

        /* =========================
           FEATURES
        ========================= */

        .feature-section {
            background: var(--light);
        }

        .feature-item {
            display: flex;
            gap: 18px;
            margin-bottom: 28px;
        }

        .feature-icon {
            min-width: 52px;
            height: 52px;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .feature-item h5 {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .feature-item p {
            color: #6b7280;
            margin: 0;
        }

        /* =========================
           TRAINER
        ========================= */

        .trainer-card {
            border: 1px solid #e5e7eb;
            border-radius: 15px;
            overflow: hidden;
            text-align: center;
            background: white;
        }

        .trainer-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .trainer-info {
            padding: 20px;
        }

        .trainer-info h5 {
            font-weight: 800;
        }

        .trainer-info p {
            color: var(--primary);
            margin-bottom: 0;
        }

        /* =========================
           CTA
        ========================= */

        .cta-section {
            background:
                linear-gradient(
                    rgba(17,24,39,0.94),
                    rgba(17,24,39,0.94)
                ),
                url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1800&q=85')
                center/cover;
            color: white;
        }

        .cta-section h2 {
            font-size: 42px;
            font-weight: 800;
        }

        .cta-section p {
            color: #d1d5db;
            font-size: 18px;
        }

        /* =========================
           TESTIMONIAL
        ========================= */

        .testimonial-card {
            background: white;
            border: 1px solid #e5e7eb;
            padding: 30px;
            border-radius: 15px;
            height: 100%;
        }

        .stars {
            color: var(--primary);
            margin-bottom: 15px;
        }

        .testimonial-card p {
            color: #6b7280;
            line-height: 1.8;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: var(--dark);
            color: white;
            padding-top: 70px;
        }

        footer h5 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        footer p,
        footer a {
            color: #9ca3af;
        }

        footer a {
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        footer a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            margin-top: 50px;
            padding: 20px 0;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width: 768px) {

            .hero-slide {
                min-height: 550px;
            }

            .hero-content h1 {
                font-size: 40px;
            }

            .hero-content p {
                font-size: 16px;
            }

            .section-padding {
                padding: 65px 0;
            }

            .section-title h2 {
                font-size: 30px;
            }

        }

    </style>

    @stack('styles')

</head>


<body>

    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    @stack('scripts')

</body>

</html>
