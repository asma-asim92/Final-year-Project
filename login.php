<?php
error_reporting(0);
session_start();
include 'connection.php';


if(isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];
$roll=$_POST['roll'];




$select2=mysqli_query($conn,"SELECT *FROM register WHERE username='$username'AND password='$password'");
$check_user=mysqli_num_rows($select2);
$row=mysqli_fetch_array($select2);
$status=$row['status'];
if($check_user==0){
    echo '<script type="text/javascript">';
echo 'alert("data is not found in database");';
echo 'window.location.href ="login.php"';
echo '</script>';
}
if($roll=="user"){

if($check_user==1){
$_SESSION["status"]=$row["status"];
$_SESSION["username"]=$row["username"];
$_SESSION["password"]=$row["password"];
$_SESSION["user_id"]=$row["id"];


if($status=="0"){
    echo '<script type="text/javascript">';
    echo 'alert("user request is pending");';
    echo 'window.location.href ="login.php"';
    echo '</script>';
    


}
if($status=="1"){
   
    session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["user_id"]=$row["id"];
                            echo ("<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('user Login Successfully')
                            window.location.href='user/user.php';
                            </SCRIPT>");

                            

}
if($status=="2"){
    echo '<script type="text/javascript">';
    echo 'alert("user request is rejected by the admin");';
    echo 'window.location.href ="login.php"';
    echo '</script>';
    


}
}

}
else{

if($roll=="admin"){

    if($check_user==1){
    $_SESSION["status"]=$row["status"];
    $_SESSION["username"]=$row["username"];
    $_SESSION["password"]=$row["password"];
    $_SESSION["user_id"]=$row["id"];
    
    if($status=="admin"){
   
        session_start();
                                $_SESSION["username"] = $username;
                                $_SESSION["id"] = $id;
                                $_SESSION["user_id"]=$row["id"];
                                echo ("<SCRIPT LANGUAGE='JavaScript'>
                                window.alert('admin Login Successfully')
                                window.location.href='admin/admin.php';
                                </SCRIPT>");
    
                                
    
    }
   
}
}
}
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Login Page </title>
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


  <form action="login.php" method="POST" class="mt-5">



                

                  <h5 class="fw-normal mt-5 mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
<label class="form-label" for="form2Example17">LOGIN AS</label>
                  <select class="form-select mb-3" name="roll" aria-label="Default select example">
  <option value disabled selected>LOGIN AS</option>
  <option value="admin">ADMIN</option>
  <option value="user">DEVELOPER</option>
</select>

                  <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">USERNAME</label>

                    <input type="text" id="form2Example17" name="username" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">PASSWORD</label>

                    <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" />
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-primary btn-lg btn-block w-100" name="login" type="submit">Login</button>
                  </div>

                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php"
                      style="color: #393f81;">Register here</a></p>
                </form>
                
             
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>