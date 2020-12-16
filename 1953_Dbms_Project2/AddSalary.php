<?php
$FNAME=$_POST['FNAME'];
$LNAME=$_POST['LNAME'];
$BANK_ACC_NO=$_POST['BANK_ACC_NO'];

$DATE=$_POST['DATE'];
// $BASIC_DA=$_POST['BASIC_DA'];
// $HRA=$_POST['HRA'];
// $CONVEYANCE=$_POST['CONVEYANCE'];
// $PF=$_POST['PF'];
// $ESI=$_POST['ESI'];
//
$EMI=$_POST['EMI'];
// $TAX=$_POST['TAX'];


$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");


if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// $sql = "UPDATE Employee
// SET FNAME = '$FNAME', LNAME= '$LNAME',CITY = '$CITY',STATE = '$STATE',DOB = '$DOB',PHONE_NO = '$PHONE_NO',BANK_ACC_NO = '$BANK_ACC_NO'
// WHERE Email='$EMAIL' ";

$query = "SELECT EID FROM EMPLOYEE WHERE BANK_ACC_NO='$BANK_ACC_NO'";
$result = $mysqli->query($query);
$abc = $result->fetch_assoc();
$id=$abc['EID'];

// print_r($id);
// var_dump(implode($id,$query));
$sql="INSERT INTO SALARY (EMI,PAY_DATE,EID) VALUES ('$EMI','$DATE','$id')";

// $sql2="SELECT * FROM EMPLOYEE WHERE BANK_ACC_NO='$BANK_ACC_NO'";
//  $result=$mysqli->query($sql2);
//  // $EID = $result->fetch_assoc();
//  $EID = $result->fetch_array(MYSQLI_ASSOC);
// $id=$result['EID'];
// echo ' VALUE IS  '. $id;
// $EID  = $result['EID'];
// $sql="INSERT INTO SALARY (EMI,PAY_DATE,EID) VALUES ('$EMI','$DATE','$followingdata')";


// $result = $dbh->prepare( "SELECT * FROM EMPLOYEE WHERE BANK_ACC_NO='$BANK_ACC_NO'" );
//
// $result->setFetchMode(PDO::FETCH_ASSOC);
// $result->execute();
//
// $EID  = $result['EID'];
// $sql="INSERT INTO SALARY (EMI,PAY_DATE,EID) VALUES ('$EMI','$DATE','$EID')";

if( $mysqli->query($sql) === true ){
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
