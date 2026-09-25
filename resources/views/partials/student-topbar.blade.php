<div class="topbar">

    <div>

        <h5 class="mb-0">
            @yield('page-title', 'Student Dashboard')
        </h5>

    </div>


    <div class="gap-2 d-flex align-items-center">

        <div
            class="rounded-circle d-flex align-items-center justify-content-center"
            style="
                width:40px;
                height:40px;
                background:#c49a5a;
                color:white;
            "
        >
            <i class="bi bi-person"></i>
        </div>

        <div>

            <strong>
                {{ $user->name }}
            </strong>

            <small class="d-block text-muted">
                Student
            </small>

        </div>

    </div>

</div>
