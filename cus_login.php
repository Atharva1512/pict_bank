<?php
if(isset($_POST['user_login'])){
  include "config.php";

  $acc = $_POST['login_id'];
  $pass= $_POST['password'];
  $query = "SELECT * FROM customer_user WHERE acct_no='$acc'";

  $result=mysqli_query($con,$query);

  if($result){
    if(mysqli_num_rows($result)==1){
      $data=mysqli_fetch_assoc($result);
      if(md5($pass)==$data['password']){
        session_start();
        $_SESSION['username'] = $data["name"];
        $_SESSION['acct_no'] = $data['acct_no'];
        header("location:cus_service.php");      
      }
      else{
        echo "password not matching";
      }

    }
    else{
      echo "User does not exist.";
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
    <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body{
            background-color: #508bfc;
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

            <h3 class="mb-5">Sign in</h3>
            <form action="cus_login.php" method="post">
              <div class="form-outline mb-4">
                <input type="text" name="login_id" id="login_id" placeholder="Enter your account no" class="form-control form-control-lg" />
                <label class="form-label" for="login_id">LogIn ID</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control form-control-lg" />
                <label class="form-label" for="password">Password</label>
              </div>

              <button class="btn btn-primary btn-lg btn-block" name="user_login" type="submit">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>