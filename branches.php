<?php
    include "config.php";

    $all_branch = "SELECT * FROM branch_info;";

    $result=mysqli_query($con,$all_branch);    

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Our Branch Locations</title>
    <link rel="stylesheet" type="text/css" href="web1.css">
  </head>
  <body>
      <div class="title">     
          <h1>OUR BRANCHES</h1>
      </div>
    <div class="main">

        <ul>
            <?php
            while( $branch_data=mysqli_fetch_array($result) ){
                // echo "$branch_data[branch_name] <br>";
                echo "<li><details><summary>$branch_data[branch_name]</summary><p><ul><li>Address:$branch_data[branch_addr]</li><li>Telephone No:$branch_data[tel_no]</li><li>Email:$branch_data[email]</li><li>Working Hours:$branch_data[work_hr]</li></ul></p></details></li>";
            }
            ?>

        </ul>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>



