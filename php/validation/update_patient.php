<?php
session_start();

include "../db/db_config.php";
include "../db/authentication.php";

$patient_id = $_GET["patient_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = array();

  if (empty($_POST["firstName"])) {
    $errors[] = "First name is required!";
  } else {
    $firstName = mysqli_real_escape_string($connection, $_POST["firstName"]);
  }

  if (empty($_POST["lastName"])) {
    $errors[] = "Last name is required!";
  } else {
    $lastName = mysqli_real_escape_string($connection, $_POST["lastName"]);
  }

  if (empty($_POST["dob"])) {
    $errors[] = "Date of birth is required!";
  } else {
    $dob = mysqli_real_escape_string($connection, $_POST["dob"]);
  }

  if (empty($_POST["gender"])) {
    $errors[] = "Gender is required!";
  } else {
    $gender = mysqli_real_escape_string($connection, $_POST["gender"]);
  }

  if (empty($_POST["address"])) {
    $errors[] = "Address is required!";
  } else {
    $address = mysqli_real_escape_string($connection, $_POST["address"]);
  }

  if (empty($_POST["contact"])) {
    $errors[] = "Contact is required!";
  } else {
    $contact = mysqli_real_escape_string($connection, $_POST["contact"]);
  }

  if (empty($_POST["allergies"])) {
    $allergies = NULL;
  } else {
    $allergies = mysqli_real_escape_string($connection, $_POST["allergies"]);
  }

  if (empty($_POST["conditions"])) {
    $conditions = NULL;
  } else {
    $conditions = mysqli_real_escape_string($connection, $_POST["conditions"]);
  }

  if (empty($errors)) {
    $sql = "UPDATE patients 
            SET first_name = '$firstName', 
                last_name = '$lastName', 
                date_of_birth = '$dob', 
                gender = '$gender', 
                address = '$address', 
                contact = '$contact', 
                allergies = '$allergies', 
                pre_existing_conditions = '$conditions'
            WHERE patient_id = '$patient_id'";

    $result = mysqli_query($connection, $sql);
    if ($result) {
      header("Location: ../../dashboard/view_patient.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
  } else {
    header("Location: ../../dashboard/update_patient.php?patient_id=$patient_id");
  }
}
