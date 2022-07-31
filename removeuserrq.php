<?php

include 'config.php';

$id = $_GET['id'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  // sql to delete a record
$sql = "UPDATE users set status=9 where id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: accountIndex.php');
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>