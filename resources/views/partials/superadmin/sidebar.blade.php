<div class="sidebar">

    <div class="logo">
        <i class="bi bi-mortarboard-fill"></i>
        Training System
    </div>

    <div class="menu-title">Main</div>

    <a href="{{ route('super-admin.dashboard') }}"
       class="{{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <div class="menu-title">Management</div>

    <a href="{{ route('super-admin.users.index') }}"><i class="bi bi-people"></i> Users</a>
     <a href="{{ route('super-admin.students.index') }}"><i class="bi bi-person-workspace"></i>Students</a>
    <a href="{{ route('super-admin.roles.index') }}"><i class="bi bi-diagram-3"></i> Roles & Permissions</a>

    <div class="menu-title">Training</div>

    <a href="{{ route('super-admin.training-categories.index') }}"><i class="bi bi-grid"></i> Categories</a>
    <a href="{{ route('super-admin.courses.index') }}"><i class="bi bi-book"></i> Courses</a>
    <a
    href="{{ route('super-admin.trainers.index') }}"class="{{ request()->routeIs('super-admin.trainers.*') ? 'active' : '' }}"><i class="bi bi-person-badge"></i>
    Trainers
</a>
   <a href="{{ route('super-admin.batches.index') }}"><i class="bi bi-collection"></i> Batches</a>

   <a href="{{ route('super-admin.training-sessions.index') }}" class="{{ request()->routeIs('super-admin.training-sessions.*') ? 'active' : '' }}">
 <i class="bi bi-camera-video"></i>Training Sessions</a>



    <a href="{{ route('super-admin.videos.index') }}"><i class="bi bi-camera-video"></i> Videos</a>

    <a href="{{ route('super-admin.study-materials.index') }}"
   class="{{ request()->routeIs('super-admin.study-materials.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-text"></i>
    Study Materials
</a>

    <a href="#"><i class="bi bi-calendar3"></i> Schedules</a>

    <div class="menu-title">Academic</div>

    <a href="{{ route('super-admin.assignments.index') }}"
   class="{{ request()->routeIs('super-admin.assignments.*') ? 'active' : '' }}">

    <i class="bi bi-clipboard-check"></i>

    Assignments

</a>

<a href="{{ route('super-admin.online-tests.index') }}"
   class="{{ request()->routeIs('super-admin.online-tests.*') ? 'active' : '' }}">
    <i class="bi bi-ui-checks-grid"></i>
    Online Tests
</a>
    <a href="{{ route('super-admin.certificates.index') }}"><i class="bi bi-award"></i> Certificates</a>
    <a href="#"><i class="bi bi-calendar-check"></i> Attendance</a>

    <div class="menu-title">System</div>

    <a href="#"><i class="bi bi-credit-card"></i> Payments</a>
    <a href="#"><i class="bi bi-bar-chart"></i> Reports</a>
    <a href="#"><i class="bi bi-gear"></i> Settings</a>

    <form method="POST" action="{{ route('super-admin.logout') }}">
        @csrf
        <button
            type="submit"
            class="btn btn-link text-decoration-none w-100 text-start"
            style="color:#d1d5db; padding:11px 12px;"
        >
            <i class="bi bi-box-arrow-right me-2"></i>
            Logout
        </button>
    </form>

</div>
