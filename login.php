<?php
require("config.php");

session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  header("location: index.php");
}

if(isset($_POST['login'])){
  $enrolmentId_email=$_POST['enrolmentId_email'];
  $password=$_POST['password'];

  $user_exist_query="SELECT * FROM `users` WHERE `enrolmentId`='$enrolmentId_email' OR `email`='$enrolmentId_email'";
  $result=mysqli_query($conn,$user_exist_query);

  if($result){
    if(mysqli_num_rows($result)==1){
      $result_fetch=mysqli_fetch_assoc($result);
      if(password_verify($password,$result_fetch['password'])){
        $_SESSION['loggedin'] = true;
        $_SESSION['enrolmentId']=$result_fetch['enrolmentId'];
        header("location: index.php");
        echo"
          <script>
            alert('Login Successful');
          </script>
        ";
      }else{
        echo"
          <script>
            alert('Wrong credentials');
          </script>
        ";
      }
    }else{
      echo"
          <script>
            alert('User not found');
          </script>
        ";
    }
  }
  else{
    echo"
          <script>
            alert('Query cannot run');
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
      <h1 class="d-inline-block">Hello Again!</h1>
      <img class="onboarding-img" src="./images/login_img.svg" alt="login image" />
    </div>
    <div class="col d-flex flex-column justify-content-center align-items-center text-center"">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">mail</span>
        <input type="text" name="enrolmentId_email" id="enrolmentId_email" placeholder="Enter Your Enrolment Id or Email" required autofocus />
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-rounded">lock</span>
        <input type="password" id="password" name="password" placeholder="Enter Password" required />
      </div>
      <div class="form-item-other">
        <div class="checkbox">
          <input type="checkbox" name="rememberMe" id="rememberMeCheckbox" />
          <label for="rememberMeCheckbox">Remember Me</label>
        </div>
        <a href="#">Forget Password?</a>
      </div>
      <button class="login-btn" name="login" type="submit">Login</button>
      </form>
      <div class="login-card-footer">
        Don't have an account?
        <a href="signup.php">Create a free account</a>
      </div>
    </div>
  </main>
</body>

</html>