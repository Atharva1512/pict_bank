<?php
if(isset($_POST['staff_login'])){

  include "config.php";

  $id =$_POST['login_id'];
  $pass =$_POST['pass'];
  $query = "SELECT * FROM office_user WHERE login_id='$id'";
  $result=mysqli_query($con,$query);
  
  if($result){
    if(mysqli_num_rows($result)==1){
      $data = mysqli_fetch_assoc($result);
      if($pass==$data["password"]){
        header("location: ofc.php");
      }
    }
    else{
      echo "Incorrect acct no.";
    }
  }
  else{
    echo "ERROR '$con->error'";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body{
            background-color: #F93154;
        }
    </style>
</head>
<body>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Office Sign in</h3>
            <form action="ofc_login.php" method="post">
              <div class="form-outline mb-4">
                <input type="text" name="login_id" id="login_id" class="form-control form-control-lg" />
                <label class="form-label" for="login_id">LogIn ID</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="pass" id="pass" class="form-control form-control-lg" />
                <label class="form-label" for="pass">Password</label>
              </div>

              <button class="btn btn-primary btn-lg btn-block" type="submit" name="staff_login">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>