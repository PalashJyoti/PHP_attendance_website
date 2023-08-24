<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";

function sanitize($data)
{
  global $conn;
  return mysqli_real_escape_string($conn, $data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = sanitize($_POST["name"]);
  $enrolmentId = sanitize($_POST["enrolmentId"]);
  $course = sanitize($_POST["course"]);
  $semester = sanitize($_POST["semester"]);
  $dob = sanitize($_POST["dob"]);
  $email = sanitize($_POST["email"]);
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

  $sql = "INSERT INTO users (enrolmentId, name, course, semester, dob, email, password) 
          VALUES ('$enrolmentId', '$name', '$course', '$semester', '$dob', '$email', '$password')";

  if ($conn->query($sql) === false) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
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
      <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
        <input type="date" name="dob" id="dob" placeholder="Enter DOB" required />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">mail</span>
        <input type="email" name="email" id="email" placeholder="Enter Email" required />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">lock</span>
        <input type="password" name="password" id="password" placeholder="Enter Password" required />
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