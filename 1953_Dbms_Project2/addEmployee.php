<?php

session_start();

$FNAME=$_POST['FNAME'];
$LNAME=$_POST['LNAME'];
$CITY=$_POST['CITY'];
$STATE=$_POST['STATE'];
$DOB=$_POST['DOB'];
// $PHONE_NO=$_POST['PHONE_NO'];
$BANK_ACC_NO=$_POST['BANK_ACC_NO'];
$EMAIL=$_POST['EMAIL'];

$DEPARTMENT_NAME=$_POST['DEPARTMENT'];
$DESIGNATION=$_POST['DESIGNATION'];
$GENDER=$_POST['GENDER'];

$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");


if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$EID=$_SESSION['EID'];
$sql = "UPDATE Employee
SET FNAME = '$FNAME', LNAME= '$LNAME',CITY = '$CITY',STATE = '$STATE',DOB = '$DOB',BANK_ACC_NO = '$BANK_ACC_NO',GENDER='$GENDER'
WHERE EMAIL='$EMAIL' AND EID='$EID'";

//IF FINANCE AND SENIOR
$sql2="INSERT INTO DEPARTMENT (DEPT_NAME,DESIGNATION,EID) VALUES ('$DEPARTMENT_NAME','$DESIGNATION','$EID')";
if($DEPARTMENT_NAME=='FINANCE')
{
  if($DESIGNATION=='SENIOR'){

    $sql3="UPDATE DEPARTMENT SET FID='2' WHERE EID='$EID'";

  }elseif ($DESIGNATION=='JUNIOR') {

    $sql3="UPDATE DEPARTMENT SET FID='1' WHERE EID='$EID'";

  }elseif ($DESIGNATION=='TEMPORARY') {

    $sql3="UPDATE DEPARTMENT SET FID='3' WHERE EID='$EID'";

  }
}
  elseif ($DEPARTMENT_NAME=='HR') {
  if($DESIGNATION=='SENIOR'){

    $sql3="UPDATE DEPARTMENT SET FID='4' WHERE EID='$EID'";

  }elseif ($DESIGNATION=='JUNIOR') {

    $sql3="UPDATE DEPARTMENT SET FID='5' WHERE EID='$EID'";

  }elseif ($DESIGNATION=='TEMPORARY') {

    $sql3="UPDATE DEPARTMENT SET FID='6' WHERE EID='$EID'";

  }
}
elseif ($DEPARTMENT_NAME=='SALES') {
  if($DESIGNATION=='SENIOR'){

    $sql3="UPDATE DEPARTMENT SET FID='7' WHERE EID='$EID'";

  }elseif($DESIGNATION=='JUNIOR') {

    $sql3="UPDATE DEPARTMENT SET FID='8' WHERE EID='$EID'";

  }elseif($DESIGNATION=='TEMPORARY') {

    $sql3="UPDATE DEPARTMENT SET FID='9' WHERE EID='$EID'";

  }
}
    // $sql3="UPDATE DEPARTMENT SET FID='2' WHERE DEPT_NAME='FINANCE' AND DESIGNATION='SENIOR' AND EID='$EID'";
    // $sql4="UPDATE DEPARTMENT SET FID='1' WHERE DEPT_NAME='FINANCE' AND DESIGNATION='JUNIOR' AND EID='$EID'";
    // $sql5="UPDATE DEPARTMENT SET FID='3' WHERE DEPT_NAME='FINANCE' AND DESIGNATION='TEMPORARY' AND EID='$EID'";
    //
    // $sql6="UPDATE DEPARTMENT SET FID='4' WHERE DEPT_NAME='HR' AND DESIGNATION='SENIOR' AND EID='$EID'";
    // $sql7="UPDATE DEPARTMENT SET FID='5' WHERE DEPT_NAME='HR' AND DESIGNATION='JUNIOR' AND EID='$EID'";
    // $sql8="UPDATE DEPARTMENT SET FID='6' WHERE DEPT_NAME='HR' AND DESIGNATION='TEMPORARY' AND EID='$EID'";
    //
    // $sql9="UPDATE DEPARTMENT SET FID='7' WHERE DEPT_NAME='SALES' AND DESIGNATION='SENIOR' AND EID='$EID'";
    // $sql22="UPDATE DEPARTMENT SET FID='8' WHERE DEPT_NAME='SALES' AND DESIGNATION='JUNIOR' AND EID='$EID'";
    // $sql23="UPDATE DEPARTMENT SET FID='9' WHERE DEPT_NAME='SALES' AND DESIGNATION='TEMPORARY' AND EID='$EID'";



//   }
// }
// ||
// $mysqli->query($sql4) === true ||$mysqli->query($sql5) === true ||$mysqli->query($sql6) === true ||
// $mysqli->query($sql7) === true ||$mysqli->query($sql8) === true ||$mysqli->query($sql9) === true ||
// $mysqli->query($sql22) === true ||$mysqli->query($sql23) === true)

if($mysqli->query($sql) === true && $mysqli->query($sql2) === true &&  $mysqli->query($sql3) === true ){
    echo "Records inserted successfully.";
// <input type="button" onclick="alert(\'Clicky!\')"/>;
echo "<script>alert('received!'); location.href='AddEmployee.html';</script>";


} else{
echo "<script>alert('ERROR:.Check email Id Or Bank account Number!'); location.href='AddEmployee.html';</script>";


}

$mysqli->close();
?>
