<?php
require_once "config.php";

$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // check if username is empty
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter a username.";
  } else {
    $sql = "SELECT id FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      // set the value of param email
      $param_email = trim($_POST['email']);

      // try to execute this statement
      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
          $email_err = "email already exist";
        } else {
          $email = trim($_POST['email']);
        }
      } else {
        echo "Something went wrong";
      }
    }
  }
  mysqli_stmt_close($stmt);

  // check for password
  if (empty(trim($_POST['password']))) {
    $password_err = "Password cannot be blank";
  } elseif (strlen(trim($_POST['password'])) < 8) {
    $password_err = 'Password must have atleast 8 characters';
  } else {
    $password = trim($_POST['password']);
  }

  // check for cofirm password
  if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
    $confirm_password_err = "Password should mattch";
  }

  // if there were no error insert into database
  if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
    $sql = "INSERT INTO users (email,password) VALUES (?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);

      // set these parameters
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      // try to execute the query
      if (mysqli_stmt_execute($stmt)) {
        header("location: login.php");
      } else {
        echo "Something went wrong cannot redirect";
      }
    }
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AttendWise</title>
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
  <main class="row justify-content-center align-items-center" style="min-height: 100vh">
    <div class="col d-flex flex-column justify-content-center align-items-center text-center">
      <h1 class="d-inline-block">Hello!</h1>
      <img class="onboarding-img" src="./images/signup_img.svg" alt="signup image" />
    </div>
    <div class="col d-flex flex-column justify-content-center
      align-items-center text-center"">
      <form action="" method=" post">
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">person</span>
        <input type="text" name="name" id="name" placeholder="Enter Name" required autofocus />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">fingerprint</span>
        <input type="text" name="enrolmentId" id="enrolmentId" placeholder="Enter Enrolment id" required />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">library_books</span>
        <input type="text" name="course" id="course" placeholder="Enter Course" required />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">schedule</span>
        <select class="custom-selector" name="semester" id="semester">
          <option value="0">Select Your Semester</option>
          <option value="1">1st Semester</option>
          <option value="2">2nd Semester</option>
          <option value="3">3rd Semester</option>
          <option value="4">4th Semester</option>
        </select>
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">book</span>
        <input type="date" name="dob" id="dob" placeholder="Enter DOB" required autofocus />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">mail</span>
        <input type="email" name="email" id="email" placeholder="Enter Email" required />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">lock</span>
        <input type="text" name="password" id="password" placeholder="Enter Password" required />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">lock</span>
        <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" required />
      </div>
      <button class="signup-btn" type="submit">Sign Up</button>
      </form>
      <div class="login-card-footer">
        Already have an account?
        <a href="login.html">Login</a>
      </div>
  </main>
</body>

</html>