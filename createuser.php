<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/createuser.css">
</head>

<body style="background-color : #ececec;">
<?php
    include 'config.php';
    if(isset($_POST['submit'])){
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
    $balance=$_POST['balance'];
    $ALL_DONE=false;
    // check if user exsits using the NID 
    $sql ="SELECT * FROM users WHERE nid like '%$nid%'";

   $query =mysqli_query($conn, $sql);

    if(mysqli_num_rows($query))
    {
      echo "<script> alert('User Already Exsists! Please check The National identification Number.');
                     </script>";
    }
    else{
 
    $sql="insert into users(name,phone,address,notes,nid,image,email,gender,balance) values
    ('{$name}', '{$phone}' ,'{$address}' ,'{$notes}' ,'{$nid}' ,'{$filename}' ,'{$email}','{$gender}','{$balance}')";
    $result=mysqli_query($conn,$sql);
    if (move_uploaded_file($tempname, $folder)) {
      $ALL_DONE=true;
  } else {
      echo "<h3>  Failed to upload image!</h3>";
  }
    if($ALL_DONE){
               echo "<script> alert('User has been created!');
                               window.location='accountIndex.php';
                     </script>";
                    
    }
  }
  }
?>

<?php
  include 'navbar.php';
?>

        <h2 class="text-center pt-4" style="color : #6c757d;">Create a User</h2>
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
        <img class="img-fluid" id="blah" src="img/user3.jpg" style="border: none; border-radius: 10%;" alt="" />
          <input accept="image/*" type='file' id="imgInp" name="uploadfile" value="" 
          style="border: none; border-radius: 10%; width: 50%;" />
        </div>
        <div class="screen-body-item">
            <div class="app-form-group">
              <input class="app-form-control" placeholder="FULLNAME" type="text" name="name" required>
            </div>
            <div class="app-form-group">
              <input class="app-form-control" placeholder="PHONE" type="phone" name="phone" required>
            </div>
            <div class="app-form-group">
              <input class="app-form-control" placeholder="National Identification Number"
               type="number" name="nid" required>
            </div>
            <div class="app-form-group">
              <textarea class="app-form-control" placeholder="Address" name="address" required></textarea>
            </div>
            <div class="app-form-group">
              <input class="app-form-control" placeholder="EMAIL" type="email" name="email" required>
            </div>
            <div class="app-form-group">
              <select name="gender" class="app-form-control" type="text" required>
                <option selected>SELECT</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            
            <div class="app-form-group">
              <input class="app-form-control" placeholder="INITIAL BALANCE" type="number" name="balance" required>
            </div>
            <div class="app-form-group">
              <textarea class="app-form-control" placeholder="Notes" rows="5" name="notes"></textarea>
            </div>
            <br>
            <div class="app-form-group button">
              <input class="app-form-button" style="color:#4d865a;" type="submit" value="CREATE USER" name="submit"></input>
              <input class="app-form-button" style="color:#dc3545;" type="reset" value="RESET" name="reset"></input>
            </div>
          
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script> 
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
</script>
</body>
</html>