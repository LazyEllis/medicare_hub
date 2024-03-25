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
    $errors[] = "Date of diagnosis is required!";
  } else {
    $date = mysqli_real_escape_string($connection, $_POST["date"]);
  }

  if (empty($_POST["diagnosis"])) {
    $errors[] = "Diagnosis details are required!";
  } else {
    $diagnosis = mysqli_real_escape_string($connection, $_POST["diagnosis"]);
  }

  if (empty($_POST["notes"])) {
    $notes = NULL;
  } else {
    $notes = mysqli_real_escape_string($connection, $_POST["notes"]);
  }

  if (empty($errors)) {
    $sql = "INSERT INTO diagnoses (patient_id, diagnosis_date, diagnosis_details, notes) 
            VALUES ('$patient', '$date', '$diagnosis', '$notes')";

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
