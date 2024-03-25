<?php
session_start();

include "../php/db/db_config.php";
include "../php/db/authentication.php";
$name = $_SESSION["name"];

$patient_id = $_GET["patient_id"];
$query = "SELECT *, 
          CONCAT(patients.first_name, ' ', patients.last_name) AS patient_name
          FROM treatments 
          JOIN patients ON patients.patient_id = treatments.patient_id
          WHERE treatments.patient_id = $patient_id";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicare | View Treatments</title>
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
        </li>
        <li class="sidebar-section mb-4">
          <span class="sidebar-heading">Diagnoses</span>
          <a href="add_diagnosis.php" class="btn btn-sidebar text-start border-0">Add Diagnoses</a>
        </li>
        <li class="sidebar-section mb-4">
          <span class="sidebar-heading">Treatments</span>
          <button class="btn btn-sidebar text-start w-100 border-0 active">View Treatments</button>
          <a href="add_treatment.php" class="btn btn-sidebar text-start border-0">Add Treatments</a>
        </li>
        <li class="sidebar-section mb-4">
          <span class="sidebar-heading">Logout</span>
          <a href="logout.php" class="btn btn-sidebar text-start border-0">Logout</a>
        </li>
      </ul>
    </div>
    <div class="main text-bg-content w-100">
      <div class="header px-2 py-1 px-md-4 d-flex align-items-center justify-content-between">
        <button class="btn sidebar-toggle py-0 px-2 d-md-none" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
          <i class="bi bi-list fs-2 text-white"></i>
        </button>
        <h1 class="mb-0 fs-5">View Treatments</h1>
        <button class="btn sidebar-toggle py-0 px-2 invisible">
          <i class="bi bi-list fs-2 text-white"></i>
        </button>
      </div>
      <div class="content py-4 px-5" data-bs-theme="dark">
        <div class="table-responsive">
          <table class="table table-content">
            <thead>
              <tr>
                <th>Patient Name</th>
                <th>Date of Treatment</th>
                <th>Treatment Details</th>
                <th>Dosage Instructions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><?php echo $row["patient_name"] ?></td>
                  <td><?php echo $row["treatment_date"] ?></td>
                  <td><?php echo $row["treatment_details"] ?></td>
                  <td><?php echo $row["dosage_instructions"] ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>