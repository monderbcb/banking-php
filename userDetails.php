<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/createuser.css">
</head>

<body style="background-color : #ececec;">
<?php
    include 'config.php';
    if(isset($_POST['submit'])){
    $id=$_GET['id'];
    $overDraw = $_POST['overDraw'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $nid=$_POST['nid']; //
    $notes=$_POST['notes'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $ALL_DONE=false;
    // check if user exsits using the NID 
    $sql ="SELECT * FROM users WHERE nid like '%$nid%'";
    // check old data serching wit user id insted of nid to difrentiate betwwen the same user id and the new nid
    $oldSql ="SELECT * FROM users WHERE id= $id ; ";
    $oldQuery =mysqli_query($conn, $oldSql);
    $oldRow = mysqli_fetch_array($oldQuery);
   $query =mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) && $oldRow['nid'] != $nid)
    {
      echo "<script> alert('User Already Exsists! Please check The National identification Number.');
              window.location='userDetails.php?id=$id';         
            </script>";
    }
    else{
     
      $sql="UPDATE `users` SET `name`='{$name}',`email`='{$email}'
      ,`gender`='{$gender}',`nid`='{$nid}',`phone`='{$phone}'
      ,`address`='{$address}',`notes`='{$notes}',`image`='{$filename}' , `overDraw` = {$overDraw}
       WHERE `id`={$id}";
      $result=mysqli_query($conn,$sql);
      // sql error
      if(mysqli_error($conn))
      echo "<script> alert('error occurred while executing query: ".mysqli_error($conn)."');
        </script>" ;
      if(!$oldRow['image'] == $filename) {
          if (move_uploaded_file($tempname, $folder)) {
            $ALL_DONE=true;
        } else {
            echo "<h3>  Failed to upload image!</h3>";
        }
      }else { 
        $ALL_DONE=true;
      }
   
      if($ALL_DONE){
               echo "<script> alert('User has been Updated!');
                     </script>";
                    
    }
  }
  }
?>

<?php
  include 'navbar.php';
  $id=$_GET['id'];
  $sql ="SELECT * FROM users WHERE id= $id ; ";

  $query =mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);
?>

        <h2 class="text-center pt-4" style="color : #6c757d;"> User Details</h2>
        <br>

  <div class="background">
  <div class="container">
    <div class="screen">
      <div class="screen-header">
        <div class="screen-header-right">
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
        </div>
      </div>

      <div class="screen-body">
        <div class="screen-body-item left">
      
        <form class="app-form" method="post" enctype="multipart/form-data">
        <img class="img-fluid" id="blah" src="image/<?php echo $row['image'] ?>" style="border: none; border-radius: 10%;" alt="" />
          <input accept="image/*" type='file' id="imgInp" name="uploadfile" value="" 
          style="border: none; border-radius: 10%; width: 50%;" />
        </div>
        <div class="screen-body-item">
            <div class="app-form-group">
              <input class="app-form-control" placeholder="Name" value="<?php echo $row['name'] ?>" type="text" name="name" required>
            </div>
            <div class="app-form-group">
              <input class="app-form-control" placeholder="Phone" value="<?php echo $row['phone'] ?>" type="phone" name="phone" required>
            </div>
            <div class="app-form-group">
              <input class="app-form-control" value="<?php echo $row['nid'] ?>" placeholder="NID"
               type="number" name="nid" required>
            </div>
            <div class="app-form-group">
              <textarea class="app-form-control" placeholder="Address"  name="address" required>
              <?php echo $row['address'] ?>
              </textarea>
            </div>
            <div class="app-form-group">
              <input class="app-form-control" placeholder="Email" value="<?php echo $row['email'] ?>" type="email" name="email" required>
            </div>
            <div class="app-form-group">
              <input class="app-form-control" placeholder="Over Draw" value="<?php echo $row['overDraw'] ?>" type="number" name="overDraw">
            </div>
            <div class="app-form-group">
              <select name="gender" placeholder="Gender" class="app-form-control" type="text" required>
              
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            
            <div class="app-form-group">
              <textarea class="app-form-control" placeholder="Notes" placeholder="Notes" rows="5" name="notes">
              <?php echo $row['notes'] ?>
              </textarea>
            </div>
            <br>
            <div class="app-form-group button">
              <input class="app-form-button" style="color:#4d865a;" type="submit" value="Update USER" name="submit"></input>
            </div>
          
        </div>
        </form>
      </div>
    </div>
   
  </div>
  
</div>
<table id="dtBasicExample" class="table table-hover table-striped table-condensed table-dark table-bordered">
        <thead style="color : white;">
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
                <th class="text-center">Notes</th>
                <th class="text-center">Check Number</th>
                <th class="text-center">Transaction Type</th>

            </tr>
        </thead>
        <tbody>
        <?php

            include 'config.php';

            $sql ="SELECT transaction.sno ,transaction.checkNumber , transaction.balance as ammount , transaction.datetime ,
             transaction.notes as tranNotes , transaction.status , transaction.actionType ,
              sender.name as senderName , receiver.name as receiverName FROM `transaction`
               JOIN users sender ON transaction.senderId = sender.id
               JOIN users receiver ON transaction.receiverId = receiver.id
               WHERE sender.id = $id OR receiver.id = $id Order BY transaction.datetime DESC";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr style="color : white;">
            <td class="py-2"><?php echo $rows['sno']; ?></td>
            <td class="py-2"><?php echo $rows['senderName']; ?></td>
            <td class="py-2"><?php echo $rows['receiverName']; ?></td>
            <td class="py-2">LYD. <?php echo $rows['ammount']; ?> /-</td>
            <td class="py-2"><?php echo $rows['datetime']; ?> </td>
            <td class="py-2"><?php echo $rows['tranNotes']; ?> </td>
            <td class="py-2"><?php echo $rows['checkNumber']; ?> </td>
            <td class="py-2"><?php switch ($rows['actionType']) {
            case 1 :
                 echo 'Deposit';
                break;
            case 2 :
                echo 'Withdrawal';
                break;
            case 3 :
                echo 'Transferred';
                break;
            
            }
            ?> </td>

                
        <?php
            }

        ?>
        </tbody>
    </table>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
                   <script>
                        $(document).ready(function () {
                        $('#dtBasicExample').DataTable();
                        $('.dataTables_length').addClass('bs-select');
                        });
                        imgInp.onchange = evt => {
                        const [file] = imgInp.files
                        if (file) {
                          blah.src = URL.createObjectURL(file)
                        }
                      };
                    </script>
</body>
</html>