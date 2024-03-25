<?php
session_start();

include "../php/db/db_config.php";
include "../php/db/authentication.php";
authenticate();
$name = $_SESSION["name"];
$user_id = $_SESSION["user_id"];

$query = "SELECT *, 
          DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_of_birth)), '%Y')+0 AS age,
          CONCAT(first_name, ' ', last_name) AS full_name 
          FROM patients 
          WHERE user_id = $user_id";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicare | View Patients</title>
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
          <a href="view_patient.php" class="btn btn-sidebar text-start border-0 active">View Patients</a>
          <a href="add_patient.php" class="btn btn-sidebar text-start border-0">Add Patients</a>
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
    <div class="main text-bg-content w-100 overflow-x-auto">
      <div class="header px-2 py-1 px-md-4 d-flex align-items-center justify-content-between">
        <button class="btn sidebar-toggle py-0 px-2 d-md-none" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
          <i class="bi bi-list fs-2 text-white"></i>
        </button>
        <h1 class="mb-0 fs-5">View Patients</h1>
        <button class="btn sidebar-toggle py-0 px-2 invisible">
          <i class="bi bi-list fs-2 text-white"></i>
        </button>
      </div>
      <div class="content py-4 px-5" data-bs-theme="dark">
        <div class="table-responsive">
          <table class="table table-content">
            <thead>
              <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Contact Info</th>
                <th>Allergies</th>
                <th>Pre-existing conditions</th>
                <th>View Diagnoses</th>
                <th>View Treatments</th>
                <th>Update Patient</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td class="align-middle"><?php echo $row["full_name"] ?></td>
                  <td class="align-middle"><?php echo $row["age"] ?></td>
                  <td class="align-middle"><?php echo $row["gender"] ?></td>
                  <td class="align-middle"><?php echo $row["address"] ?></td>
                  <td class="align-middle"><?php echo $row["contact"] ?></td>
                  <td class="align-middle"><?php echo ($row["allergies"] !== "") ? $row["allergies"] : "N/A" ?></td>
                  <td class="align-middle"><?php echo ($row["pre_existing_conditions"]) ? $row["pre_existing_conditions"] : "N/A" ?></td>
                  <td class="align-middle"><a href="view_diagnosis.php?patient_id=<?php echo $row["patient_id"] ?>" class="btn btn-white">View Diagnoses</a></td>
                  <td class="align-middle"><a href="view_treatment.php?patient_id=<?php echo $row["patient_id"] ?>" class="btn btn-white">View Treatments</a></td>
                  <td class="align-middle"><a href="update_patient.php?patient_id=<?php echo $row["patient_id"] ?>" class="btn btn-white">Update Patient</a></td>
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