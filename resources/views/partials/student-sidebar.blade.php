<div class="sidebar">

    <div class="sidebar-brand">

        <h5 class="mb-1">
            <i class="bi bi-mortarboard-fill me-2"></i>
            Training Portal
        </h5>

        <small class="text-secondary">
            Student Panel
        </small>

    </div>


    {{-- Dashboard --}}

    <a
        href="{{ route('student.dashboard') }}"
        class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
    >
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>


    {{-- My Courses --}}

  @can('courses.view')

    <a
        href="{{ route('student.courses.index') }}"
        class="{{ request()->routeIs('student.courses*') ? 'active' : '' }}"
    >
        <i class="bi bi-book"></i>
        My Courses
    </a>

@endcan


    {{-- My Batches --}}

  @can('batches.view')

    <a
        href="{{ route('student.batches.index') }}"
        class="{{ request()->routeIs('student.batches*') ? 'active' : '' }}"
    >
        <i class="bi bi-collection"></i>
        My Batches
    </a>

@endcan


    {{-- Online Tests --}}

    @can('tests.view')

        <a
            href="#"
            class="{{ request()->routeIs('student.tests*') ? 'active' : '' }}"
        >
            <i class="bi bi-ui-checks-grid"></i>
            Online Tests
        </a>

    @endcan


    {{-- Assignments --}}

  @can('assignments.view')

    <a
        href="{{ route('student.assignments.index') }}"
        class="{{ request()->routeIs('student.assignments*') ? 'active' : '' }}"
    >
        <i class="bi bi-clipboard-check"></i>
        Assignments
    </a>

@endcan


    {{-- Study Materials --}}

  @can('materials.view')

    <a
        href="{{ route('student.materials.index') }}"
        class="{{ request()->routeIs('student.materials*') ? 'active' : '' }}"
    >
        <i class="bi bi-file-earmark-text"></i>
        Study Materials
    </a>

@endcan


    {{-- Training Videos --}}

    @can('videos.view')

        <a
            href="#"
            class="{{ request()->routeIs('student.videos*') ? 'active' : '' }}"
        >
            <i class="bi bi-play-circle"></i>
            Training Videos
        </a>

    @endcan


    {{-- Attendance --}}

    @can('attendance.view')

        <a
            href="#"
            class="{{ request()->routeIs('student.attendance*') ? 'active' : '' }}"
        >
            <i class="bi bi-calendar-check"></i>
            Attendance
        </a>

    @endcan


    {{-- Results --}}

    @can('results.view')

        <a
            href="#"
            class="{{ request()->routeIs('student.results*') ? 'active' : '' }}"
        >
            <i class="bi bi-bar-chart"></i>
            Results
        </a>

    @endcan


    {{-- Certificates --}}

    @can('certificates.view')

        <a
            href="#"
            class="{{ request()->routeIs('student.certificates*') ? 'active' : '' }}"
        >
            <i class="bi bi-award"></i>
            Certificates
        </a>

    @endcan


    {{-- Profile --}}

    <a
        href="#"
        class="{{ request()->routeIs('student.profile*') ? 'active' : '' }}"
    >
        <i class="bi bi-person"></i>
        My Profile
    </a>


    <hr>


    {{-- Logout --}}

    <form
        action="{{ route('student.logout') }}"
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
