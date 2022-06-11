<?php
    include "config.php";
    session_start();

    $query = "SELECT * FROM customer_user WHERE acct_no='$_SESSION[acct_no]'";
    
    $result=mysqli_query($con,$query);

    $data=mysqli_fetch_assoc($result);

//-----logout---------
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location: /pict_bank");
}    
// -------Money Transfer part---------------------
if(isset($_POST["money_transfer"])){
    $to = "SELECT * FROM customer_user WHERE acct_no='$_POST[transfer_to]';";

    $to_query = mysqli_query($con,$to);

    $to_data = mysqli_fetch_assoc($to_query);

    if($to_query){
        if(mysqli_num_rows($to_query)==1){
            if(md5($_POST['conf_password'])==$data['password']){
                if($_POST['amt']>$data['balance']){
                    echo "not enough money to transfer";
                }                    
                else{
                    $rem=$data['balance']-$_POST['amt'];
                    $add=$data['balance']+$_POST['amt'];
                    $ans_query = "UPDATE customer_user SET balance=$rem WHERE acct_no = '$_SESSION[acct_no]';
                                UPDATE customer_user SET balance=$add WHERE acct_no = '$_POST[transfer_to]';
                                INSERT INTO `transactions` ( `from_acct_no`, `from_name`, `to_acct_no`, `to_name`, `amount`, `transact_date`) VALUES ('$_SESSION[acct_no]', '$_SESSION[username]', '$to_data[acct_no]', '$to_data[name]', '$_POST[amt]', CURRENT_DATE());"; 

                    if($con->multi_query($ans_query)){
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Money transfered succesfully</strong>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
                    }
                    else{
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Transaction failed!</strong>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
                    }
                }   
            }
            else{
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Password not matching</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
            }                                                              
        }
        else{
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>User not found</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
    }
    else{
        echo "error";
    }
}

//-----------------paying bills----------------
if(isset($_POST['pay_bill'])){
    if(md5($_POST['conf_password'])==$data['password']){
        if($_POST['amt']>$data['balance']){
            echo "not enough money to transfer";
        } 
        else{
            $rem=$data['balance']-$_POST['amt'];
            $ans_query = "UPDATE customer_user SET balance=$rem WHERE acct_no = '$_SESSION[acct_no]';INSERT INTO `transactions` ( `from_acct_no`, `from_name`, `to_acct_no`, `to_name`, `amount`, `transact_date`) VALUES ('$_SESSION[acct_no]', '$_SESSION[username]', '$_POST[pay_id]', '$_POST[pay_to]', '$_POST[amt]', CURRENT_DATE());"; 

            if($con->multi_query($ans_query)){
                echo "Bill payed succesfully";
            }
            else{
                echo "Transaction failed!";
            }
        }
    }
    else{
        echo "Password not matching!";
    }
}

//-----------------Invest in FD----------------
// if(isset($_POST['fdi'])){
//     if(md5($_POST['conf_password'])==$data['password']){
//         if($_POST['invest_fd']>$data['balance']){
//             echo "not enough money to transfer";
//         } 
//         else{
//             $rem=$data['balance']-$_POST['amt'];
//             $ans_query = "UPDATE customer_user SET balance=$rem ,SET fd_status="1"  WHERE acct_no = '$_SESSION[acct_no]';INSERT INTO fd_info ('acct_no','name','amount','deposit_dt') values($_SESSION[acct_no],$_SESSION[username],$_POST[invest_fd],CURRENT_DATE());"; 

//             if($con->multi_query($ans_query)){
//                 echo "FD created succesfully";
//             }
//             else{
//                 echo "Transaction failed!";
//             }
//         }
//     }
//     else{
//         echo "Password not matching!";
//     }
// }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

      .cards1{
        display: flex;
        justify-content: center;
        margin: 20px;
        text-align: center;
      }

      .cards2{
        display: flex;
        justify-content: center;
        margin: 20px;
        text-align: center;
      }

      #c2{
        width: max-content;
      }

      .card{
        margin: 20px;
      }

      img{
          height: 300px;
      }

      button{
          margin: 10px;
          padding:2px 5px;
      }

      form{
        display:flex;
        flex-direction:column;
      }
    </style>
    <title>Customer Services</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><?php
            echo "hello ".$_SESSION['username']."<br>" ;
        ?></a>
       
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="#"><form action="cus_service.php" method="post"><button type="submit" name="logout" >Logout</button></form>
</a>
            
            </div>
        </div>
    </nav>
        

    <div class="cards1">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="transfer.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">
            <details>
                <summary>Transfer Money</summary>
                <p>
                    <form action="cus_service.php" method="post">
                        <label for="transfer_to">To Account no</label>
                        <input type="number" name="transfer_to" id="transfer_to">
                        <label for="amt">Amount</label>
                        <input type="number" name="amt" id="amt" min="0">
                        <label for="conf_password">Enter your password to confirm</label>
                        <input type="password" name="conf_password" id="conf_password">

                        <button type="submit" name="money_transfer">Transfer</button>
                    </form>
                </p>
            </details>
        </p>
        </div>
    </div>

    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="bill.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text"><details>
        <summary>Pay Bills</summary>
        <p>
            <form action="cus_service.php" method="post">
                <label for="pay_to">Payment of</label>
                <input type="text" name="pay_to" id="pay_to" placeholder="Like Light Bill, Tax,etc." required>
                <label for="pay_id">Payment ID</label>
                <input type="text" name="pay_id" id="pay_id" placeholder="Enter the EMI ID,TAX ID,BILL ID,etc." required>
                <label for="amt">Amount</label>
                <input type="number" name="amt" id="amt" min="0" >
                <label for="conf_password">Enter your password to confirm</label>
                <input type="password" name="conf_password" id="conf_password">

                <button type="submit" name="pay_bill">Pay Bill</button>
            </form>
        </p>
    </details></p>
        </div>
    </div>

    </div>
    <div class="cards2">
    <div class="card" id="c2">
        <img class="card-img-top" src="hist.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text"><details>
            <?php
                $history = "SELECT * FROM transactions WHERE from_acct_no = $_SESSION[acct_no] OR to_acct_no = $_SESSION[acct_no];";
                $h_query = mysqli_query($con,$history);
            ?>
        <summary>See Transaction History</summary>
        <p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">From account no</th>
                    <th scope="col">From name</th>
                    <th scope="col">to account no</th>
                    <th scope="col">To name</th>
                    <th scope="col">Amount transfered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($h_data=mysqli_fetch_array($h_query)){
                        echo "<tr>
                        <th scope=row>$h_data[ID]</th>
                        <td>$h_data[from_acct_no]</td>
                        <td>$h_data[from_name]</td>
                        <td>$h_data[to_acct_no]</td>
                        <td>$h_data[to_name]</td>
                        <td>$h_data[amount]</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </p>
    </details></p>
        </div>
    </div>

    <div class="card" id="c2">
        <img class="card-img-top" src="stats.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">
    <details>
        <?php
        $last_t="SELECT * FROM transactions WHERE from_acct_no = $_SESSION[acct_no] OR to_acct_no = $_SESSION[acct_no] ORDER BY transact_date DESC LIMIT 1;";

        $res_last=mysqli_query($con,$last_t);
        $last_store= mysqli_fetch_assoc($res_last);

        $max_t="SELECT MAX(amount) as max_val FROM transactions WHERE from_acct_no = $_SESSION[acct_no] OR to_acct_no = $_SESSION[acct_no];";

        $res_max=mysqli_query($con,$max_t);
        $max_store= mysqli_fetch_assoc($res_max);
        
        $avg_t = "SELECT AVG(amount) as avg_val FROM transactions WHERE from_acct_no = $_SESSION[acct_no] OR to_acct_no = $_SESSION[acct_no];";

        $res_avg=mysqli_query($con,$avg_t);
        $avg_store= mysqli_fetch_assoc($res_avg);

        $spend = "SELECT SUM(amount) as spend_val FROM transactions WHERE from_acct_no = $_SESSION[acct_no];";

        $res_spend=mysqli_query($con,$spend);
        $spend_store= mysqli_fetch_assoc($res_spend);

        $receive = "SELECT SUM(amount) as rec_val FROM transactions WHERE to_acct_no = $_SESSION[acct_no];";

        $res_rec=mysqli_query($con,$receive);
        $receive_store= mysqli_fetch_assoc($res_rec);

        $no_t = "SELECT COUNT(amount) as cnt FROM transactions WHERE from_acct_no = $_SESSION[acct_no] OR to_acct_no = $_SESSION[acct_no];";

        $res_no=mysqli_query($con,$no_t);
        $no_store= mysqli_fetch_assoc($res_no);
        ?>
        <summary>Some Notable Stats</summary>
        <p>
            <ul>
                <?php echo 
                    "<li>Last Transaction: From acct no $last_store[from_acct_no] to acct no $last_store[to_acct_no] of Rs. $last_store[amount] on date $last_store[transact_date] </li>
                    <li>Max Amount of transaction: $max_store[max_val] </li>
                    <li>Avg of last 10 transactions: $avg_store[avg_val] </li>
                    <li>Total Money Dedited Till Now:$spend_store[spend_val] </li>
                    <li>Total Money Credited Till Now:$receive_store[rec_val]</li>
                    <li>Total no of Transactions Till Now:$no_store[cnt]</li>";
                ?>
            </ul>
        </p>
    </details></p>
        </div>
    </div>
    </div>

    <!-- <details>
        <summary>Invest in FD</summary>
        <p>
            <form action="cus_service.php" method="post">
                <label for="invest_fd">Amount</label>
                <input type="number" name="invest_fd" id="invest_fd">
                <label for="conf_password">Enter your password to confirm</label>
                <input type="password" name="conf_password" id="conf_password">

                <button type="submit" name="fdi">Invest</button>
            </form>
        </p>
    </details>

    <details>
        <summary>Withdraw FD</summary>
        <p>
            <form action="cus_service.php" method="post">
                <label for="wd_fd">Amount</label>
                <input type="text" name="wd_fd" id="wd_fd">
                <label for="conf_password">Enter your password to confirm</label>
                <input type="password" name="conf_password" id="conf_password">

                <button type="submit" name="fdw">Withdraw</button>
            </form>
        </p>
    </details> -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>