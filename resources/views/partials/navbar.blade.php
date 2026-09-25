<!-- =====================================================
     NAVBAR
===================================================== -->

<nav class="navbar navbar-expand-lg main-navbar sticky-top">

    <div class="container">

        <a
            class="navbar-brand"
            href="{{ url('/') }}"
        >
            <i class="bi bi-mortarboard-fill me-2"></i>
            Training<span>Portal</span>
        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
        >
            <span class="navbar-toggler-icon"></span>
        </button>


        <div
            class="collapse navbar-collapse"
            id="mainNavbar"
        >

            <ul class="mx-auto mb-2 navbar-nav mb-lg-0">

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ url('/') }}"
                    >
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href=""
                    >
                        Courses
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#categories"
                    >
                        Categories
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#trainers"
                    >
                        Trainers
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#about"
                    >
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#contact"
                    >
                        Contact
                    </a>
                </li>

            </ul>


            <div class="gap-2 d-flex">

                <a
                    href="{{ route('student.login') }}"
                    class="btn btn-login"
                >
                    Login
                </a>

                <a
                    href=""
                    class="btn btn-enroll"
                >
                    Explore Courses
                </a>

            </div>

        </div>

    </div>

</nav>
