<?php
include "../db/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = array();

  // Validates against empty fields
  if (empty($_POST["email"])) {
    $errors[] = "Email is required!";
  } else {
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
  }

  if (empty($_POST["password"])) {
    $errors[] = "Password is required!";
  } else {
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
  }

  if (empty($errors)) {
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
      session_start();
      $row = mysqli_fetch_assoc($result);
      $_SESSION["name"] = $row["first_name"] . " " . $row["last_name"];
      $_SESSION["user_id"] = $row["user_id"];

      header("location: ../../dashboard/view_patient.php");
    } else {
      echo "Invalid email or password!";
    }
  } else {
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
  }
}
