<?php
include "../db/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = array();

  // Validates against empty fields
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

  if (empty($_POST["confirmPassword"])) {
    $errors[] = "Please confirm your password!";
  } else {
    $confirmPassword = mysqli_real_escape_string($connection, $_POST["confirmPassword"]);
  }

  // Validates against invalid email format
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  // Validates against already existing emails
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($connection, $sql);
  if (mysqli_num_rows($result) > 0) {
    $errors[] = "Email already exists!";
  }

  // Validates against password requirements
  if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    $errors[] = "Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.";
  }

  // Validates against password confirmation
  if ($password !== $confirmPassword) {
    $errors[] = "Your passwords do not match!";
  }

  if (empty($errors)) {
    $sql = "INSERT INTO users (first_name, last_name, email, password) 
            VALUES ('$firstName', '$lastName', '$email', '$password')";

    if (mysqli_query($connection, $sql)) {
      header("location: ../../auth/login.html");
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
