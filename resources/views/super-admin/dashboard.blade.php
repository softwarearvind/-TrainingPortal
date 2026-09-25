@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

    <!-- WELCOME -->
    <div class="welcome">
        <h3>Welcome back, Super Admin 👋</h3>
        <p class="mb-0 text-white-50">
            Manage your complete Training Management System from one place.
        </p>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-people"></i></div>
                <div class="stat-number">{{ $totalUsers ?? '1,250' }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-book"></i></div>
                <div class="stat-number">{{ $totalCourses ?? '86' }}</div>
                <div class="stat-label">Total Courses</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-person-video3"></i></div>
                <div class="stat-number">{{ $totalTrainers ?? '42' }}</div>
                <div class="stat-label">Trainers</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-currency-rupee"></i></div>
                <div class="stat-number">{{ $totalRevenue ?? '₹4.85L' }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>

    </div>

    <!-- SECOND ROW -->
    <div class="row g-4 mb-4">

        <!-- QUICK ACTIONS -->
        <div class="col-lg-8">
            <div class="dashboard-card">
                <h5>Quick Actions</h5>
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <a href="#" class="quick-btn">
                            <i class="bi bi-person-plus"></i>
                            Add User
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="quick-btn">
                            <i class="bi bi-book"></i>
                            Add Course
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="quick-btn">
                            <i class="bi bi-people"></i>
                            Create Batch
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="quick-btn">
                            <i class="bi bi-file-earmark-bar-graph"></i>
                            Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- TRAINING TYPES -->
        <div class="col-lg-4">
            <div class="dashboard-card">
                <h5>Training Categories</h5>

                <div class="d-flex justify-content-between mb-3">
                    <span>Software Training</span>
                    <strong>35</strong>
                </div>
                <div class="progress mb-3" style="height:7px;">
                    <div class="progress-bar" style="width:70%; background:#c49a5a;"></div>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span>Excel Training</span>
                    <strong>28</strong>
                </div>
                <div class="progress mb-3" style="height:7px;">
                    <div class="progress-bar bg-success" style="width:55%;"></div>
                </div>

                <div class="d-flex justify-content-between">
                    <span>HR Training</span>
                    <strong>23</strong>
                </div>
                <div class="progress" style="height:7px;">
                    <div class="progress-bar bg-info" style="width:45%;"></div>
                </div>

            </div>
        </div>

    </div>

    <!-- USERS + ACTIVITY -->
    <div class="row g-4">

        <!-- RECENT USERS -->
        <div class="col-lg-8">
            <div class="dashboard-card">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Recent Users</h5>
                    <a href="#" class="text-decoration-none">View All</a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Training</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers ?? [] as $user)
                                <tr>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->training }}</td>
                                    <td>
                                        <span class="badge {{ $user->is_active ? 'badge-online' : 'badge-offline' }}">
                                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                {{-- Static fallback rows (remove once $recentUsers is passed from controller) --}}
                                <tr>
                                    <td>
                                        <strong>Rahul Sharma</strong>
                                        <br>
                                        <small class="text-muted">rahul@example.com</small>
                                    </td>
                                    <td>Student</td>
                                    <td>Laravel</td>
                                    <td><span class="badge badge-online">Active</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Priya Singh</strong>
                                        <br>
                                        <small class="text-muted">priya@example.com</small>
                                    </td>
                                    <td>Trainer</td>
                                    <td>Excel</td>
                                    <td><span class="badge badge-online">Active</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Amit Kumar</strong>
                                        <br>
                                        <small class="text-muted">amit@example.com</small>
                                    </td>
                                    <td>HR</td>
                                    <td>HR Training</td>
                                    <td><span class="badge badge-offline">Inactive</span></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- ACTIVITY -->
        <div class="col-lg-4">
            <div class="dashboard-card">
                <h5>Recent Activity</h5>

                <div class="mb-4">
                    <strong>New Student Registered</strong>
                    <div class="small text-muted">Rahul Sharma joined Laravel Training</div>
                    <div class="small text-muted mt-1">10 minutes ago</div>
                </div>

                <div class="mb-4">
                    <strong>New Course Added</strong>
                    <div class="small text-muted">Advanced Excel Training</div>
                    <div class="small text-muted mt-1">1 hour ago</div>
                </div>

                <div>
                    <strong>Certificate Generated</strong>
                    <div class="small text-muted">Certificate #CERT-1025</div>
                    <div class="small text-muted mt-1">2 hours ago</div>
                </div>

            </div>
        </div>

    </div>

@endsection
