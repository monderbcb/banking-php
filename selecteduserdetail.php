<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $actionType = $_GET['type'];
     switch ($actionType) {
        case 1:echo 'Deposit';$actionType='Deposit';  break; 
        case 2:echo 'Withdraw';$actionType='Withdraw'; break;
        case 3:echo 'Transfer';$actionType='Transfer'; break;   
        }
    $from = $_GET['id'];
    $to = $from;
    if  ($_GET['type'] == 3)
        $to = $_POST['to'];
    $amount = $_POST['amount'];
    $notes = $_POST['notes'];
    $opType = $_GET['type'];
    $checkNumber = $_POST['checkNumber'];

    $sql = "SELECT * from users where id=$from and status <> 9";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from users where id=$to and status <> 9";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be '.$actionType.'")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if(($opType == 3 || $opType == 2) && $amount > $sql1['balance']) 
    { 
        
        echo '<script type="text/javascript">';
        echo ' alert("Sorry, Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be ".$actionType."')";
         echo "</script>";
     }


    else {

            //$actionType='Deposit'; 1 
            //$actionType='Withdraw'; 2
            //$actionType='Transfer'; 3
        if  ($opType == 3 || $opType == 2) {
                // deducting amount from sender's account and incrementing checksum from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $checksum = $sql1['checksum'] + 1;
                if  ($opType == 2) 
                    
                $sql = "UPDATE users set balance=$newbalance , checksum=$checksum where id=$from";
                mysqli_query($conn,$sql);
        }
        if  ($opType == 3 || $opType == 1) {
                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                if  ($opType == 1) {
                    $checksum = $sql2['checksum'] + 1;
                    $sql = "UPDATE users set balance=$newbalance , checksum=$checksum where id=$to";
                    

                }
                mysqli_query($conn,$sql);
        }
                $sender = $sql1['id'];
                $receiver = $sql2['id'];
                $sql = "INSERT INTO transaction(`senderId`, `receiverId`, `balance` , `actionType` , `notes` , `Check Number`) 
                VALUES ('$sender','$receiver','$amount' , $opType , '$notes' ,  '$checkNumber')";
                $query=mysqli_query($conn,$sql);
                echo $conn->error; //
                if($query){
                     echo "<script> alert('Transaction Completed');
                                     window.location='transactionhistory.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction <?php     $actionType = $_GET['type'];
     switch ($actionType) {
        case 1:echo 'Deposit';$actionType='Deposit';  break; 
        case 2:echo 'Withdraw';$actionType='Withdraw'; break;
        case 3:echo 'Transfer';$actionType='Transfer'; break;   
        }?> </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">
    	
		button{
			border:none;
			background: #d9d9d9;
		}
	    button:hover{
			background-color:#777E8B;
			transform: scale(1.1);
			color:white;
		}

    </style>
</head>

<body style="background-color : #ececec;">
 
<?php
  include 'navbar.php';
?>

	<div class="container">
        <h2 class="text-center pt-4" style="color : #6c757d;">Transaction <?php echo $actionType; ?> </h2>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered table-dark">
                <tr style="color : white;">
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Total Balance</th>
                    <th class="text-center">NID</th>
                </tr>
                <tr style="color : white;">
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2">LYD. <?php echo $rows['balance'] ?></td>
                    <td class="py-2"><?php echo $rows['nid'] ?></td>
                </tr>
            </table>
        </div>
        <hr><br>
        
        <div class="row">
        
            <div class="col-6">
        <?php  if  ($actionType == 'Transfer' ){ ?>
        <label style="color : #6c757d;"><b> <?php echo $actionType; ?> To:</b></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Select Account</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid and status <> 9;";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <?php } else {
         ?>
         <label style="color : #6c757d;"><b>Check Number:</b></label>
            <input type="number" class="form-control" name="checkNumber"> 
         <img src="data:image/png;base64,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">
            
        </div>
        <?php  }
         ?>

        <div class="col-6">
            <label style="color : #6c757d;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required> 
            <br>
            <label style="color : #6c757d;"><b>Notes:</b></label>
            <input type="test" class="form-control" name="notes" required> 
        </div>
        
        </div>
              
            <br><br>
                <div class="text-center" >
            <button class="btn" name="submit" type="submit" id="myBtn" ><?php echo $actionType; ?> Amount</button>
            </div>
        </form>
    </div>
 <?php include 'footer.php'; ?>
   
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>