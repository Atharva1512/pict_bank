<?php
if(isset($_POST["name"])){
  
    include "config.php";

    $insert=false;
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $acct_no = $_POST['acct_no'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $branch = $_POST['branch'];
    $balance = $_POST['balance'];

    $user_exist_query = "SELECT * FROM customer_user WHERE name='$name' OR acct_no='$acct_no';";

    $result= mysqli_query($con,$user_exist_query);
   
    if($result){
      if(mysqli_num_rows($result)>0){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>User already exist!</strong>Please check name and account no once. 
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
      }
      else{
    
        $sql = "INSERT INTO `customer_user` ( `name`, `acct_no`, `phone_no`, `address`, `password`, `branch`, `balance`, `fd_status`, `entry_date`) VALUES ('$name', '$acct_no', '$phone', '$address', '$password', '$branch', '$balance', '0', CURRENT_DATE());";
        
        if($con->query($sql)== true){
            // echo "Succesfull <br>";
            // echo $sql;
            $insert=true;
        }
        else{
            echo "Error $con->error";
        }
      }
    }
    else{
      echo "Error $con->error";
    }


    // $insert=false;
    // $name = $_POST['name'];
    // $password = $_POST['password'];
    // $acct_no = $_POST['acct_no'];
    // $phone = $_POST['phone'];
    // $address = $_POST['address'];
    // $branch = $_POST['branch'];
    // $balance = $_POST['balance'];

    // $sql = "INSERT INTO `customer_user` ( `name`, `acct_no`, `phone_no`, `address`, `password`, `branch`, `balance`, `fd_status`, `entry_date`) VALUES ('$name', '$acct_no', '$phone', '$address', '$password', '$branch', '$balance', '0', CURRENT_DATE());";
    
    // if($con->query($sql)== true){
    //     // echo "Succesfull <br>";
    //     // echo $sql;
    //     $insert=true;
    // }
    // else{
    //     echo "Error $con->error";
    // }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>User creation</title>
    <style>
      body{
        background-color: rgb(39, 137, 223);
      }
      a {
        text-decoration: none;
        display: inline-block;
        padding: 8px 16px;
      }
        
      a:hover {
        background-color: #ddd;
        color: black;
      }

      .previous {
      background-color: #f1f1f1;
      color: black;
      }
      .round {
      border-radius: 50%;
      }
    </style>
  </head>
  <body>
  <a href="ofc.php" class="previous round">&#8249;</a>
  <?php
  if(isset($_POST['create'])){
    if($insert==true){echo
      "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>User created</strong> Now customer can use online banking.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    // else{echo
    //   "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    //   <strong>Error</strong> 
    //   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //     <span aria-hidden='true'>&times;</span>
    //   </button>
    //   </div>";
    // } 
  }
  ?>
  <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Create New Customer Account</h3>
            <form action="add_user.php" method="post">
              <div class="form-outline mb-4">
                <input type="text" name="name" id="name" class="form-control form-control-lg" required />
                <label class="form-label" for="name">Name</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control form-control-lg" required />
                <label class="form-label" for="password">Password</label>
              </div>

              <div class="form-outline mb-4">
                <input type="number" name="acct_no" id="acct_no" class="form-control form-control-lg" required/>
                <label class="form-label" for="acct_no">Account no</label>
              </div>

              <div class="form-outline mb-4">
                <input type="number" name="phone" id="phone" class="form-control form-control-lg" required />
                <label class="form-label" for="phone">phone no</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="address" id="address" class="form-control form-control-lg" required />
                <label class="form-label" for="address">Address</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="branch" id="branch" class="form-control form-control-lg" required/>
                <label class="form-label" for="branch">Branch</label>
              </div>

              <div class="form-outline mb-4">
                <input type="number" name="balance" id="balance" class="form-control form-control-lg" required/>
                <label class="form-label" for="balance">Bank Balance</label>
              </div>
              <button class="btn btn-primary btn-lg btn-block" name="create" type="submit">Create New User</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>