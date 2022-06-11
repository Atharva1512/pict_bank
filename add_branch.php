<?php
if(isset($_POST["br_name"])){
  
    include "config.php";

    $insert=false;
    $br_name = $_POST['br_name'];
    $br_address = $_POST['br_address'];
    $tel_no = $_POST['tel_no'];
    $email = $_POST['email'];
    $work_hr = $_POST['work_hr'];

    $user_exist_query = "SELECT * FROM branch_info WHERE branch_name='$br_name';";

    $result= mysqli_query($con,$user_exist_query);
   
    if($result){
      if(mysqli_num_rows($result)>0){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>Branch already exist!</strong>Please check branch name once. 
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
      }
      else{
    
        $sql = "INSERT INTO `branch_info` ( `branch_name`, `branch_addr`, `tel_no`, `email`, `work_hr`, `entry_date`) VALUES ('$br_name', '$br_address', '$tel_no', '$email', '$work_hr', current_timestamp());";
        
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

    <title>Add Branch</title>
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
      <strong>New Branch added.</strong> 
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

            <h3 class="mb-5">Add New Branch Information</h3>
            <form action="add_branch.php" method="post">
              <div class="form-outline mb-4">
                <input type="text" name="br_name" id="br_name" class="form-control form-control-lg" required />
                <label class="form-label" for="br_name">Branch Name</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="br_address" id="br_address" class="form-control form-control-lg" required />
                <label class="form-label" for="br_address">Address</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="tel_no" id="tel_no" class="form-control form-control-lg" required/>
                <label class="form-label" for="tel_no">Telephone No</label>
              </div>

              <div class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control form-control-lg" required />
                <label class="form-label" for="email">email</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="work_hr" id="work_hr" class="form-control form-control-lg" required />
                <label class="form-label" for="work_hr">Working Hours</label>
              </div>

              <button class="btn btn-primary btn-lg btn-block" name="create" type="submit">Add New Branch</button>
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