<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Money</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <link rel="stylesheet" type="text/css" href="css/table.css">
   
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">
      button{
        transition: 1.5s;
      }
      button:hover{
        background-color:#616C6F;
        color: white;
      }
    </style>
</head>

<body style="background-color : #ececec;">
<?php
    include 'config.php';
    $sql = "SELECT * FROM users WHERE status <> 9";
    $result = mysqli_query($conn,$sql);
?>

<?php
  include 'navbar.php';
?>

<div class="container">
        <h2 class="text-center pt-4" style="color : #6c757d;">Transfer Money</h2>
        <br>
            <div class="row">
                <div class="col">
                    <div class="table-responsive-sm">
                    <table id="dtBasicExample" class="table table-hover table-striped table-condensed table-dark table-bordered" cellspacing="0" width="100%" >
                        <thead style="color : white;">
                            <tr>
                            <th scope="col" class="text-center py-2">#</th>
                            <th scope="col" class="text-center py-2">Name</th>
                            <th scope="col" class="text-center py-2">E-Mail</th>
                            <th scope="col" class="text-center py-2">Balance</th>
                            <th scope="col" class="text-center py-2">NID</th>
                            <th scope="col" class="text-center py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php 
                    $cnt=1;
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr style="color : white;">
                        <td class="py-2"><?php echo $cnt;; ?></td>
                        <td class="py-2"><?php echo $rows['name']?></td>
                        <td class="py-2"><?php echo $rows['email']?></td>
                        <td class="py-2">LYD. <?php echo $rows['balance']?> /-</td>
                        <td class="py-2"><?php echo $rows['nid']?></td>
                        <td>
                        <a href="selecteduserdetail.php?id=<?php echo $rows['id'] ;?>&type=1"> <button type="button" class="btn" style="background-color : #7FFF00;" style="border-radius:0%;">Deposit</button></a>
                        <a href="selecteduserdetail.php?id=<?php echo $rows['id'] ;?>&type=2"> <button type="button" class="btn" style="background-color : grey;" style="border-radius:0%;">Withdrawal</button></a>    
                        <a href="selecteduserdetail.php?id=<?php echo $rows['id'] ;?>&type=3"> <button type="button" class="btn" style="background-color : #e6b31a;" style="border-radius:0%;">Transfer</button></a>
                    </td> 
                    </tr>
                <?php
                $cnt=$cnt+1;
                    }
                ?>
            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div> 
         </div>
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
                        </script>
</body>
</html>