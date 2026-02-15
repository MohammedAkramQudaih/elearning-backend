
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin Panel') - E-Learning</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark text-white" style="width: 250px; min-height: 100vh;">
            <div class="p-3">
                <h4 class="text-center">E-Learning Admin</h4>
                <hr class="bg-light">
                
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-dashboard me-2"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.academic-levels.index') }}" class="nav-link text-white {{ request()->routeIs('admin.academic-levels.*') ? 'active' : '' }}">
                            <i class="fas fa-layer-group me-2"></i> Academic Levels
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.majors.index') }}" class="nav-link text-white {{ request()->routeIs('admin.majors.*') ? 'active' : '' }}">
                            <i class="fas fa-book me-2"></i> Majors
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.students.index') }}" class="nav-link text-white {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                            <i class="fas fa-users me-2"></i> Students
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.testimonials.index') }}" class="nav-link text-white {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                            <i class="fas fa-star me-2"></i> Testimonials
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.news.index') }}" class="nav-link text-white {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper me-2"></i> News
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.career-submissions.index') }}" class="nav-link text-white {{ request()->routeIs('admin.career-submissions.*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase me-2"></i> Career Submissions
                        </a>
                    </li>
                    
                    <hr class="bg-light">
                    
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-white bg-danger w-100 text-start">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Page Content -->
        <div id="page-content-wrapper" style="flex: 1;">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
                    
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="container-fluid p-4">
                <!-- رسائل النجاح/الخطأ -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>