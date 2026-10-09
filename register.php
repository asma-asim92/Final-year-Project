<?php
session_start();

include 'connection.php';
if(isset($_POST['register'])){

$email=$_POST['email'];

$username=$_POST['username'];

$password=$_POST['password'];




$select="SELECT *FROM register WHERE email='$email' OR username='$username'";
$result=mysqli_query($conn,$select);
if(mysqli_num_rows($result)>0){

  echo '<script type=""text/javascript>';
  echo 'alert("change username or email !this username or email is already taken");';
  echo 'window.location.href = "register.php"';
  echo '</script>';


}
else{
$sql="INSERT INTO `register`(`id`, `email`, `username`, `password`, `status`, `type`) VALUES (NULL,'$email','$username','$password','0','user')";
mysqli_query($conn,$sql);
  echo '<script type=""text/javascript>';
  echo 'alert("you will be able to login after admin approval");';
  echo 'window.location.href = "register.php"';
  echo '</script>';
}


}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRATION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
  body {
  background: linear-gradient(to right, #ff5733, #33ff57, #0099cc);
}

form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
}

/* Style for the heading */
h5 {
  font-size: 24px;
  text-align: center;
}

/* Style for the label */
label {
  font-weight: bold;
}

/* Style for the select input */
select {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
}

/* Style for the text input */
input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
}

</style>
  </head>
  <body>
    
  <?php

include 'nav.php';

?>
  <form action="register.php" method="POST" enctype="multipart/form-data" class="mt-5">



                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">REGISTER NOW</h5>

                  <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">USERNAME</label>

                    <input type="text" id="form2Example17" name="username" class="form-control form-control-lg" />
                  </div>
                  <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">EMAIL</label>

                    <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">PASSWORD</label>

                    <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" />
                  </div>
                  


                  

                  <div class="pt-1 mb-4">
                    <button class="btn btn-primary btn-lg btn-block w-100" name="register" type="submit">REGISTER</button>
                  </div>

                  <p class="mb-5 pb-lg-2" style="color: #393f81;">already have an account? <a href="login.php"
                      style="color: #393f81;">LOGIN here</a></p>
                </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>