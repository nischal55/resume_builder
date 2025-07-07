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
    <title>Create Resume</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --sidebar-width: 250px;
        }
        body {
            background-color: #f8f9fc;
        }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            position: fixed;
            z-index: 1000;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        #content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }
        .section-title {
            font-weight: bold;
            color: #4e73df;
            margin-top: 30px;
        }
        .btn-add {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar p-3">
    <div class="sidebar-brand d-flex align-items-center justify-content-center mb-4">
        <i class="fas fa-file-alt fa-2x me-2"></i>
        <span>ResumeBuilder</span>
    </div>
    <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a class="nav-link" href="resumes.php"><i class="fas fa-file me-2"></i> My Resumes</a>
    <a class="nav-link" href="templates.php"><i class="fas fa-palette me-2"></i> Templates</a>
    <a class="nav-link" href="profile.php"><i class="fas fa-user me-2"></i> Profile</a>
    <a class="nav-link" href="settings.php"><i class="fas fa-cog me-2"></i> Settings</a>
    <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<!-- Main Content -->
<div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm">
        <div class="container-fluid">
            <h4 class="m-0">Create Resume</h4>
        </div>
    </nav>

    <form action="../../backend/services/saveResumeService.php" method="POST">
        <!-- Personal Details -->
        <h5 class="section-title">Personal Details</h5>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
                <label>LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Professional Summary</label>
            <textarea name="summary" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label>Skills (comma separated)</label>
            <input type="text" name="skills" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Certifications</label>
            <input type="text" name="certification" class="form-control">
        </div>

        <div class="mb-3">
            <label>Languages</label>
            <input type="text" name="languages" class="form-control">
        </div>

        <div class="mb-3">
            <label>Interests</label>
            <input type="text" name="interests" class="form-control">
        </div>

        <!-- Education Details -->
        <h5 class="section-title">Education</h5>
        <div id="education-section">
            <div class="education-entry row g-3 mb-3">
                <div class="col-md-4"><input type="text" name="institution_name[]" class="form-control" placeholder="Institution" required></div>
                <div class="col-md-2"><input type="date" name="started_at[]" class="form-control" required></div>
                <div class="col-md-2"><input type="date" name="end_at[]" class="form-control" required></div>
                <div class="col-md-2"><input type="text" name="gpa[]" class="form-control" placeholder="GPA"></div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm btn-remove">Remove</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm btn-add" onclick="addEducation()">+ Add More Education</button>

        <!-- Experience Details -->
        <h5 class="section-title">Experience</h5>
        <div id="experience-section">
            <div class="experience-entry row g-3 mb-3">
                <div class="col-md-4"><input type="text" name="company_name[]" class="form-control" placeholder="Company Name" required></div>
                <div class="col-md-3"><input type="text" name="position[]" class="form-control" placeholder="Position" required></div>
                <div class="col-md-2"><input type="date" name="start_date[]" class="form-control" required></div>
                <div class="col-md-2"><input type="date" name="end_date[]" class="form-control" required></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm btn-remove">Remove</button></div>
                <div class="col-12 mt-2">
                    <textarea name="responsibility[]" class="form-control" rows="2" placeholder="Responsibilities" required></textarea>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm btn-add" onclick="addExperience()">+ Add More Experience</button>

        <div class="mt-4 d-flex justify-content-end">
            <a href="dashboard.php" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Resume</button>
        </div>
    </form>
</div>

<!-- JS -->
<script>
    function addEducation() {
        const container = document.getElementById('education-section');
        const entry = document.createElement('div');
        entry.className = "education-entry row g-3 mb-3";
        entry.innerHTML = `
            <div class="col-md-4"><input type="text" name="institution_name[]" class="form-control" placeholder="Institution" required></div>
            <div class="col-md-2"><input type="date" name="started_at[]" class="form-control" required></div>
            <div class="col-md-2"><input type="date" name="end_at[]" class="form-control" required></div>
            <div class="col-md-2"><input type="text" name="gpa[]" class="form-control" placeholder="GPA"></div>
            <div class="col-md-2"><button type="button" class="btn btn-danger btn-sm btn-remove">Remove</button></div>`;
        container.appendChild(entry);
    }

    function addExperience() {
        const container = document.getElementById('experience-section');
        const entry = document.createElement('div');
        entry.className = "experience-entry row g-3 mb-3";
        entry.innerHTML = `
            <div class="col-md-4"><input type="text" name="company_name[]" class="form-control" placeholder="Company Name" required></div>
            <div class="col-md-3"><input type="text" name="position[]" class="form-control" placeholder="Position" required></div>
            <div class="col-md-2"><input type="date" name="start_date[]" class="form-control" required></div>
            <div class="col-md-2"><input type="date" name="end_date[]" class="form-control" required></div>
            <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm btn-remove">Remove</button></div>
            <div class="col-12 mt-2"><textarea name="responsibility[]" class="form-control" rows="2" placeholder="Responsibilities" required></textarea></div>`;
        container.appendChild(entry);
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove')) {
            e.target.closest('.row').remove();
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
