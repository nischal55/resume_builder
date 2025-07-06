<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResumeBuilder | Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #224abe;
            --sidebar-width: 250px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fc;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            position: fixed;
            transition: all 0.3s;
            z-index: 1000;
            decoration:none;
        }
        
        .sidebar-brand {
            height: 4.375rem;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 800;
            padding: 1.5rem 1rem;
            text-align: center;
            letter-spacing: 0.05rem;
            z-index: 1;
        }
        
        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin: 0 1rem 1rem;
        }
        
        .sidebar-heading {
            text-align: left;
            padding: 0 1rem;
            font-weight: 800;
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.4);
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            font-weight: 600;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-link i {
            margin-right: 0.25rem;
        }
        
        /* Main Content */
        #content {
            width: calc(100% - var(--sidebar-width));
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        /* Top Navigation */
        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            background-color: white;
        }
        
        .topbar #sidebarToggle {
            color: #d1d3e2;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            #content {
                width: 100%;
                margin-left: 0;
            }
            .sidebar.toggled {
                margin-left: 0;
            }
            #content.toggled {
                width: calc(100% - 250px);
                margin-left: 250px;
            }
        }
        
        /* Custom colors */
        .bg-primary-custom {
            background-color: var(--primary-color) !important;
        }
        
        .text-primary-custom {
            color: var(--primary-color) !important;
        }
        
        .progress {
            height: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <i class="fas fa-file-alt fa-2x me-2"></i>
            <span>ResumeBuilder</span>
        </div>
        <hr class="sidebar-divider">
        
        <div class="sidebar-heading">Interface</div>
        
        <li class="nav-item">
            <a class="nav-link active" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="resumes.php">
                <i class="fas fa-fw fa-file"></i>
                <span>My Resumes</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="templates.php">
                <i class="fas fa-fw fa-palette"></i>
                <span>Templates</span>
            </a>
        </li>
        
        <hr class="sidebar-divider">
        
        <div class="sidebar-heading">Account</div>
        
        <li class="nav-item">
            <a class="nav-link" href="profile.php">
                <i class="fas fa-fw fa-user"></i>
                <span>Profile</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="settings.php">
                <i class="fas fa-fw fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="../logout.php">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </div>

    <!-- Content Wrapper -->
    <div id="content">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand topbar mb-4 static-top shadow">
            <button id="sidebarToggle" class="btn btn-link d-md-none rounded-circle me-3">
                <i class="fa fa-bars"></i>
            </button>
            
        </nav>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="new-resume.php" class="d-none d-sm-inline-block btn btn-sm btn-primary-custom shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Create New Resume
                </a>
            </div>
            
            <!-- Content Row -->
            <div class="row">
                <!-- Total Resumes Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-primary-custom text-uppercase mb-1">
                                        Total Resumes</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Templates Available Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Templates Available</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-palette fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Completion Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Profile Completion
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 me-3 font-weight-bold text-gray-800">65%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm me-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Views Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Recent Views</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-eye fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Row -->
            <div class="row">
                <!-- Recent Resumes -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary-custom">Recent Resumes</h6>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Software Engineer Resume</h6>
                                        <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">Updated with latest project details</p>
                                    <small>Modern Template</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Marketing Specialist</h6>
                                        <small>1 week ago</small>
                                    </div>
                                    <p class="mb-1">Added new certifications</p>
                                    <small>Creative Template</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Student Resume</h6>
                                        <small>2 weeks ago</small>
                                    </div>
                                    <p class="mb-1">Initial draft</p>
                                    <small>Simple Template</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary-custom">Quick Actions</h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4 mb-4">
                                    <a href="new-resume.php" class="btn btn-primary-custom btn-circle btn-lg">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <p class="mt-2 mb-0">New Resume</p>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <a href="templates.php" class="btn btn-success btn-circle btn-lg">
                                        <i class="fas fa-palette"></i>
                                    </a>
                                    <p class="mt-2 mb-0">Templates</p>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <a href="profile.php" class="btn btn-info btn-circle btn-lg">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <p class="mt-2 mb-0">Edit Profile</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Resume Templates Preview -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary-custom">Popular Templates</h6>
                            <a href="templates.php" class="btn btn-sm btn-primary-custom">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100">
                                        <img src="https://via.placeholder.com/300x400/4e73df/ffffff?text=Modern" class="card-img-top" alt="Modern Template">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Modern</h5>
                                            <a href="#" class="btn btn-sm btn-primary-custom">Use Template</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100">
                                        <img src="https://via.placeholder.com/300x400/1cc88a/ffffff?text=Creative" class="card-img-top" alt="Creative Template">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Creative</h5>
                                            <a href="#" class="btn btn-sm btn-primary-custom">Use Template</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100">
                                        <img src="https://via.placeholder.com/300x400/36b9cc/ffffff?text=Professional" class="card-img-top" alt="Professional Template">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Professional</h5>
                                            <a href="#" class="btn btn-sm btn-primary-custom">Use Template</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100">
                                        <img src="https://via.placeholder.com/300x400/f6c23e/ffffff?text=Simple" class="card-img-top" alt="Simple Template">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Simple</h5>
                                            <a href="#" class="btn btn-sm btn-primary-custom">Use Template</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; ResumeBuilder Pro <?php echo date('Y'); ?></span>
                </div>
            </div>
        </footer>
    </div>
    <!-- End of Content Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom scripts -->
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('sidebar').classList.toggle('toggled');
            document.getElementById('content').classList.toggle('toggled');
        });
        
        // Close sidebar when clicking outside on mobile
        document.getElementById('content').addEventListener('click', function() {
            if (window.innerWidth < 768) {
                if (document.getElementById('sidebar').classList.contains('toggled')) {
                    document.getElementById('sidebar').classList.remove('toggled');
                    document.getElementById('content').classList.remove('toggled');
                }
            }
        });
    </script>
</body>
</html>