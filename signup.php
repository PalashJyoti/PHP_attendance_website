<?php
require('config.php');

session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  header("location: index.php");
}

if(isset($_POST['register'])){
  $name=$_POST['name'];
  $enrolmentId=$_POST['enrolmentId'];
  $course=$_POST['course'];
  $semester=$_POST['semester'];
  $dob=$_POST['dob'];
  $email=$_POST['email'];
  $password=password_hash($_POST['password'],PASSWORD_BCRYPT);

  $user_exist_query="SELECT * FROM `users` WHERE `enrolmentId`='$enrolmentId' OR `email`='$email'";
  $result=mysqli_query($conn,$user_exist_query);

  if($result){
    if(mysqli_num_rows($result)>0){
      $result_fetch=mysqli_fetch_assoc($result);
      if($result_fetch['enrolmentId']==$enrolmentId){
        echo"
        <script>
        alert('Enrolment Id already exist');
        </script>
        ";
      }else{
        echo"
        <script>
        alert('$result_fetch[email] - email already registered');
        </script>
        ";
      }
    }
    else{
      $query="INSERT INTO `users`(`name`, `enrolmentId`, `course`, `semester`, `dob`, `email`, `password`) VALUES ('$name','$enrolmentId','$course','$semester','$dob','$email','$password')";
      if(mysqli_query($conn,$query)){
        echo"
        <script>
        alert('Registration Successful');
        </script>
        ";
      }
      else{
        echo"
        <script>
        alert('cannot run query');
        </script>
        ";
      }
    }
  }else{
    echo"
      <script>
        alert('cannot run query');
      </script>
    ";
  }
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
      <button class="signup-btn" name="register" type="submit">Sign Up</button>
      </form>
      <div class="login-card-footer">
        Already have an account?
        <a href="login.php">Login</a>
      </div>
  </main>
</body>

</html>