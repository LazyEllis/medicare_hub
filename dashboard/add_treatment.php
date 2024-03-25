<?php
session_start();

include "../php/db/db_config.php";
include "../php/db/authentication.php";
$name = $_SESSION["name"];
$user_id = $_SESSION["user_id"];

$query = "SELECT patient_id, CONCAT(first_name, ' ', last_name) AS full_name 
          FROM patients 
          WHERE user_id = $user_id";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicare | Add Treatments</title>
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
          <a href="add_treatment.php" class="btn btn-sidebar text-start border-0 active">Add Treatments</a>
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
        <h1 class="mb-0 fs-5">Add Treatments</h1>
        <button class="btn sidebar-toggle py-0 px-2 invisible">
          <i class="bi bi-list fs-2 text-white"></i>
        </button>
      </div>
      <div class="content py-4 px-5">
        <form action="../php/validation/add_treatment.php" method="post">
          <div class="form-group mb-3" data-bs-theme="dark">
            <label for="patient">Patient</label>
            <select class="form-select" id="patient" name="patient" required>
              <option value="">Select Patient</option>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <option value="<?php echo $row["patient_id"] ?>"><?php echo $row["full_name"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group mb-3" data-bs-theme="dark">
            <label for="date">Date of Treatment</label>
            <input type="date" class="form-control" id="date" name="date" required />
          </div>
          <div class="form-group mb-3">
            <label for="treatment">Treatment</label>
            <textarea class="form-control" id="treatment" name="treatment" placeholder="Treatment Details" required></textarea>
          </div>
          <div class="form-group mb-3">
            <label for="dosage">Dosage</label>
            <textarea class="form-control" id="dosage" name="dosage" placeholder="Dosage Instructions"></textarea>
          </div>
          <div class="form-group mb-3">
            <button type="submit" class="btn btn-white border-0 w-100">
              Add Treatment
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>