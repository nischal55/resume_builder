<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}
require 'db.php';

$user_id = $_SESSION['user_id'];

// Collect personal details
$dob          = $_POST['dob'];
$linkedin     = $_POST['linkedin'];
$summary      = $_POST['summary'];
$skills       = $_POST['skills'];
$certification= $_POST['certification'];
$languages    = $_POST['languages'];
$interests    = $_POST['interests'];
$created_at   = date("Y-m-d H:i:s");

// Insert into personal_details
$stmt = $conn->prepare("INSERT INTO personal_details (dob, linkedin, summary, skills, certification, languages, interests, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $dob, $linkedin, $summary, $skills, $certification, $languages, $interests, $created_at);
if ($stmt->execute()) {
    $personal_id = $stmt->insert_id;
} else {
    die("Error inserting personal details: " . $stmt->error);
}
$stmt->close();

// Collect education arrays
$institutions = $_POST['institution_name'];
$start_edu    = $_POST['started_at'];
$end_edu      = $_POST['end_at'];
$gpas         = $_POST['gpa'];

// Insert each education row
$eduStmt = $conn->prepare("INSERT INTO education_details (institution_name, started_at, end_at, gpa) VALUES (?, ?, ?, ?)");
for ($i = 0; $i < count($institutions); $i++) {
    $eduStmt->bind_param("ssss", $institutions[$i], $start_edu[$i], $end_edu[$i], $gpas[$i]);
    if (!$eduStmt->execute()) {
        die("Error inserting education: " . $eduStmt->error);
    }
}
$eduStmt->close();

// Collect experience arrays
$companies     = $_POST['company_name'];
$positions     = $_POST['position'];
$responsibilty = $_POST['responsibility'];
$start_exp     = $_POST['start_date'];
$end_exp       = $_POST['end_date'];

// Insert each experience row
$expStmt = $conn->prepare("INSERT INTO experience_details (company_name, position, responsibility, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
for ($i = 0; $i < count($companies); $i++) {
    $expStmt->bind_param("sssss", $companies[$i], $positions[$i], $responsibilty[$i], $start_exp[$i], $end_exp[$i]);
    if (!$expStmt->execute()) {
        die("Error inserting experience: " . $expStmt->error);
    }
}
$expStmt->close();

$conn->close();
header("Location: resumes.php?success=1");
exit();
?>
