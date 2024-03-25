<?php
session_start();

include "../db/db_config.php";
include "../db/authentication.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = array();

  if (empty($_POST["patient"])) {
    $errors[] = "Patient is required!";
  } else {
    $patient = mysqli_real_escape_string($connection, $_POST["patient"]);
  }

  if (empty($_POST["date"])) {
    $errors[] = "Date of treatment is required!";
  } else {
    $date = mysqli_real_escape_string($connection, $_POST["date"]);
  }

  if (empty($_POST["treatment"])) {
    $errors[] = "Treatment details are required!";
  } else {
    $treatment = mysqli_real_escape_string($connection, $_POST["treatment"]);
  }

  if (empty($_POST["dosage"])) {
    $dosage = NULL;
  } else {
    $dosage = mysqli_real_escape_string($connection, $_POST["dosage"]);
  }

  if (empty($errors)) {
    $sql = "INSERT INTO treatments (patient_id, treatment_date, treatment_details, dosage_instructions) 
            VALUES ('$patient', '$date', '$treatment', '$dosage')";

    if (mysqli_query($connection, $sql)) {
      header("location: ../../dashboard/view_patient.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
  } else {
    // Display validation errors
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
  }
}
