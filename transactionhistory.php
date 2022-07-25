<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>

<body style="background-color : #ececec;">

<?php
  include 'navbar.php';
?>

	<div class="container">
        <h2 class="text-center pt-4" style="color :#6c757d;">Transaction History</h2>
        
       <br>
       <div class="table-responsive-sm">
    <table id="dtBasicExample" class="table table-hover table-striped table-condensed table-dark table-bordered">
        <thead style="color : white;">
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
                <th class="text-center">Notes</th>
                <th class="text-center">Transaction Type</th>

            </tr>
        </thead>
        <tbody>
        <?php

            include 'config.php';

            $sql ="SELECT transaction.sno , transaction.balance as ammount , transaction.datetime ,
             transaction.notes as tranNotes , transaction.status , transaction.actionType ,
              sender.name as senderName , receiver.name as receiverName FROM `transaction`
               JOIN users sender ON transaction.senderId = sender.id
               JOIN users receiver ON transaction.receiverId = receiver.id
               WHERE sender.status <> 9 And receiver.status <> 9;";

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