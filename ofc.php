<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
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
      background-color: #1266F1;
      color: black;
      }
      .round {
      border-radius: 50%;
      }

      img{
        height: 300px;
      }

      .cards{
        display: flex;
        justify-content: center;
        margin: 20px;
        text-align: center;
      }

      .card{
        margin: 20px;
      }
    </style>
    <title>Office</title>
  </head>
  <body>
    <a href="/pict_bank" class="previous round">&#8249;</a><br>
    <div class="cards">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="user.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text"><a href="add_user.php"><button type="button" class="btn btn-info">Add new user</button></a></p>
        </div>
      </div>
      
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="branch.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text"><a href="add_branch.php"><button type="button" class="btn btn-info">Add new brnach</button></a>
          </p>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
