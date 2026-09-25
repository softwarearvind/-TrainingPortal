<div class="topbar">

    <div class="page-title">
        @yield('page-title', 'Super Admin Dashboard')
    </div>

    <div class="admin-profile">

        <div class="text-end">
            <strong>{{ auth()->user()->name ?? 'Super Admin' }}</strong>
            <div class="small text-muted">Administrator</div>
        </div>

        <div class="profile-icon">
            <i class="bi bi-person-fill"></i>
        </div>

    </div>

</div>
