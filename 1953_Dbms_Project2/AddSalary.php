<?php
session_start();
$FNAME=$_POST['FNAME'];
$LNAME=$_POST['LNAME'];
$BANK_ACC_NO=$_POST['BANK_ACC_NO'];
$DATE=$_POST['DATE'];
$EMI=$_POST['EMI'];


$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");

if($mysqli === false){
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$query = "SELECT EID FROM EMPLOYEE WHERE BANK_ACC_NO='$BANK_ACC_NO'";
$result = $mysqli->query($query);
$abc = $result->fetch_assoc();
$id=$abc['EID'];

// print_r($id);
$sql="INSERT INTO SALARY (EMI,PAY_DATE,EID) VALUES ('$EMI','$DATE','$id')";


if( $mysqli->query($sql) === true ){
  echo "Records inserted successfully.";
  // <input type="button" onclick="alert(\'Clicky!\')"/>;
  echo "<script>alert('received!'); location.href='AddSalary.html';</script>";

} else{
  // echo '<script>alert("error :not able to insert")</script>';

  echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$mysqli->close();
?>
