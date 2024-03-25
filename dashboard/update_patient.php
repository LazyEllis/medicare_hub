<?php
session_start();

include "../php/db/db_config.php";
include "../php/db/authentication.php";
$name = $_SESSION["name"];

$patient_id = $_GET["patient_id"];
$query = "SELECT * FROM patients WHERE patient_id = $patient_id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
extract($row);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicare | Add Patient</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../css/common.css" />
  <link rel="stylesheet" href="../css/dashboard.css" />
</head>

<body class="text-bg-content">
  <div class="wrapper d-flex">
    <div class="offcanvas-md offcanvas-start flex-shrink-0 vh-100 sticky-md-top text-bg-sidebar" tabindex="-1" id="sidebar">
      <div class="d-flex justify-content-between align-items-center" data-bs-theme="dark">
        <div class="sidebar-logo px-2 fw-medium"><?php echo $name ?></div>
        <div>
          <button class="btn-close d-md-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
        </div>
      </div>
      <ul class="sidebar-nav ps-0 pt-5 list-unstyled">
        <li class="sidebar-section mb-4">
          <span class="sidebar-heading">Patients</span>
          <a href="view_patient.php" class="btn btn-sidebar text-start border-0">View Patients</a>
          <a href="add_patient.php" class="btn btn-sidebar text-start border-0">Add Patients</a>
          <button class="btn btn-sidebar text-start w-100 border-0 active">Update Patients</button>
        </li>
        <li class="sidebar-section mb-4">
          <span class="sidebar-heading">Diagnoses</span>
          <a href="add_diagnosis.php" class="btn btn-sidebar text-start border-0">Add Diagnoses</a>
        </li>
        <li class="sidebar-section mb-4">
          <span class="sidebar-heading">Treatments</span>
          <a href="add_treatment.php" class="btn btn-sidebar text-start border-0">Add Treatments</a>
        </li>
        <li class="sidebar-section mb-4">
          <span class="sidebar-heading">Logout</span>
          <a href="logout.php" class="btn btn-sidebar text-start border-0">Logout</a>
        </li>
      </ul>
    </div>
    <div class="main text-bg-content d-flex flex-column flex-fill">
      <div class="header px-2 py-1 px-md-4 d-flex align-items-center justify-content-between">
        <button class="btn sidebar-toggle py-0 px-2 d-md-none" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
          <i class="bi bi-list fs-2 text-white"></i>
        </button>
        <h1 class="mb-0 fs-5">Update Patient</h1>
        <button class="btn sidebar-toggle py-0 px-2 invisible">
          <i class="bi bi-list fs-2 text-white"></i>
        </button>
      </div>
      <div class="content py-4 px-5">
        <form action="../php/validation/update_patient.php?patient_id=<?php echo $patient_id ?>" method="post">
          <div class="form-group mb-3">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Patient's First Name" value="<?php echo $first_name ?>" required />
          </div>
          <div class="form-group mb-3">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Patient's Last Name" value="<?php echo $last_name ?>" required />
          </div>
          <div class="form-group mb-3" data-bs-theme="dark">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $date_of_birth ?>" required />
          </div>
          <div class="form-group mb-3" data-bs-theme="dark">
            <label for="gender">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
              <option value="">Select Gender</option>
              <option value="Male" <?php if ($gender === "Male") echo "selected" ?>>Male</option>
              <option value="Female" <?php if ($gender === "Female") echo "selected" ?>>Female</option>
              <option value="Other" <?php if ($gender === "Other") echo "selected" ?>>Other</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" placeholder="Address" required><?php echo $address ?></textarea>
          </div>
          <div class="form-group mb-3">
            <label for="contact">Contact Info</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Information" value="<?php echo $contact ?>" required />
          </div>
          <div class="form-group mb-3">
            <label for="allergies">Allergies</label>
            <textarea class="form-control" id="allergies" name="allergies" placeholder="Any Allergies"><?php echo $allergies ?></textarea>
          </div>
          <div class="form-group mb-3">
            <label for="conditions">Pre-existing conditions</label>
            <textarea class="form-control" id="conditions" name="conditions" placeholder="Any Pre-existing Conditions"><?php echo $pre_existing_conditions ?></textarea>
          </div>
          <div class="form-group mb-3">
            <button type="submit" class="btn btn-white border-0 w-100">
              Update Patient
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>