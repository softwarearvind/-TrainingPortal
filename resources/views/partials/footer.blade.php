<!-- =====================================================
     FOOTER
===================================================== -->

<footer id="contact">

    <div class="container">

        <div class="row g-5">


            <div class="col-lg-4">

                <h5>

                    <i class="bi bi-mortarboard-fill me-2"></i>

                    Training<span style="color:#c49a5a;">
                        Portal
                    </span>

                </h5>

                <p>

                    Professional training programs designed
                    to help students develop practical,
                    career-focused skills.

                </p>


                <div class="gap-3 mt-4 d-flex">

                    <a href="#">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-linkedin fs-5"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-youtube fs-5"></i>
                    </a>

                </div>

            </div>


            <div class="col-6 col-lg-2">

                <h5>
                    Quick Links
                </h5>

                <a href="{{ url('/') }}">
                    Home
                </a>

                <a href="">
                    Courses
                </a>

                <a href="#about">
                    About
                </a>

                <a href="#contact">
                    Contact
                </a>

            </div>


            <div class="col-6 col-lg-3">

                <h5>
                    Learning
                </h5>

                <a href="">
                    Software Training
                </a>

                <a href="">
                    Excel Training
                </a>

                <a href="">
                    HR Training
                </a>

                <a href="{{ route('student.login') }}">
                    Student Login
                </a>

            </div>


            <div class="col-lg-3">

                <h5>
                    Contact Us
                </h5>

                <p>

                    <i class="bi bi-geo-alt me-2"></i>
                    Noida, Uttar Pradesh

                </p>

                <p>

                    <i class="bi bi-envelope me-2"></i>
                    info@trainingportal.com

                </p>

                <p>

                    <i class="bi bi-telephone me-2"></i>
                    +91 98765 43210

                </p>

            </div>


        </div>


        <div class="footer-bottom">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <p class="mb-0">
                        © {{ date('Y') }} Training Portal.
                        All Rights Reserved.
                    </p>

                </div>

                <div class="col-md-6 text-md-end">

                    <a
                        href="#"
                        class="d-inline-block me-3"
                    >
                        Privacy Policy
                    </a>

                    <a
                        href="#"
                        class="d-inline-block"
                    >
                        Terms & Conditions
                    </a>

                </div>

            </div>

        </div>

    </div>

</footer>
