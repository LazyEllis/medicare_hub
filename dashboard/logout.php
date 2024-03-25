<?php
session_start();

unset($_SESSION["name"]);
unset($_SESSION["user_id"]);

header("Location: ../auth/login.html");
