<?php
$FNAME=$_POST['FNAME'];
$LNAME=$_POST['LNAME'];
$DATE=$_POST['DATE'];
$BASIC_DA=$_POST['BASIC_DA'];
$HRA=$_POST['HRA'];
$CONVEYANCE=$_POST['CONVEYANCE'];
$PF=$_POST['PF'];
$ESI=$_POST['ESI'];

$EMI=$_POST['EMI'];
$TAX=$_POST['TAX'];

$mysqli = new mysqli("localhost", "root", "", "salarymanagementsystem");


if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// $sql = "UPDATE Employee
// SET FNAME = '$FNAME', LNAME= '$LNAME',CITY = '$CITY',STATE = '$STATE',DOB = '$DOB',PHONE_NO = '$PHONE_NO',BANK_ACC_NO = '$BANK_ACC_NO'
// WHERE Email='$EMAIL' ";
$sql2="INSERT INTO SALARY (SID,EMI,BASIC_DAA,HRA,CONVEYANCE,ESI,PF,TAX) VALUES (4,'$EMI','$BASIC_DA','$HRA','$CONVEYANCE','$ESI','$PF','$TAX')";

if( $mysqli->query($sql2) === true ){
    echo "Records inserted successfully.";
// <input type="button" onclick="alert(\'Clicky!\')"/>;
echo "<script>alert('received!'); location.href='AddSalary.html';</script>";

} else{
// echo '<script>alert("error :not able to insert")</script>';

    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
// header("refresh:1:url=AddEmployee.html");

// header("location:AddEmployee.html");
$mysqli->close();
?>
