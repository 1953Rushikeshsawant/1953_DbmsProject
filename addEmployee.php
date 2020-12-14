<?php

session_start();

$FNAME=$_POST['FNAME'];
$LNAME=$_POST['LNAME'];
$CITY=$_POST['CITY'];
$STATE=$_POST['STATE'];
$DOB=$_POST['DOB'];
$PHONE_NO=$_POST['PHONE_NO'];
$BANK_ACC_NO=$_POST['BANK_ACC_NO'];
$EMAIL=$_POST['EMAIL'];

$DEPARTMENT_NAME=$_POST['DEPARTMENT'];
$DESIGNATION=$_POST['DESIGNATION'];
$GENDER=$_POST['GENDER'];

$mysqli = new mysqli("localhost", "root", "", "salarymanagementsystem");


if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$EID=$_SESSION['EID'];
$sql = "UPDATE Employee
SET FNAME = '$FNAME', LNAME= '$LNAME',CITY = '$CITY',STATE = '$STATE',DOB = '$DOB',PHONE_NO = '$PHONE_NO',BANK_ACC_NO = '$BANK_ACC_NO',GENDER='$GENDER'
WHERE EMAIL='$EMAIL' AND EID='$EID'";

$sql2="INSERT INTO DEPARTMENT (DEPT_NAME,DESIGNATION,EID) VALUES ('$DEPARTMENT_NAME','$DESIGNATION','$EID')";


if($mysqli->query($sql) === true && $mysqli->query($sql2) === true ){
    echo "Records inserted successfully.";
// <input type="button" onclick="alert(\'Clicky!\')"/>;
echo "<script>alert('received!'); location.href='AddEmployee.html';</script>";
echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';


} else{
echo "<script>alert('ERROR: Could not able to execute!'); location.href='AddEmployee.html';</script>";


}

$mysqli->close();
?>
