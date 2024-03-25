<?php
function authenticate()
{
  if (!isset($_SESSION["user_id"]) && !isset($_SESSION["name"])) {
    header("Location: /emr_app/auth/login.html");
  }
}

authenticate();
