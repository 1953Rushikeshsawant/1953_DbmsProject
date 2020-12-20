<?php
session_start();
$EID=$_SESSION['EID'];
$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
$VAR_EMI="";
  $EARNING=$DEDUCTION=$NET_SALARY=$SSID="";
// Attempt select query execution
 $sql="SELECT * FROM SALARY,EMPLOYEE WHERE EMPLOYEE.EID=$EID AND SALARY.EID=EMPLOYEE.EID";

 $sql2="SELECT * FROM DEPARTMENT,FIXED_SALARY WHERE DEPARTMENT.FID=FIXED_SALARY.FID AND DEPARTMENT.EID=$EID";


////////////////

$result = $mysqli->query("SELECT EID FROM SALARY WHERE EID=$EID");
// $matchFound = $result2->num_rows > 0 ? '1' : '0';

if($result->num_rows > 0){
// if ($matchFound==='0') {



////////////////////
if($result2 = $mysqli->query($sql2)){
    if($result2->num_rows > 0){
        echo "<table class='table table-bordered table-striped'>";
            // echo "<thead>";
            // echo "<tr>";
            // echo "<th>
            // <h3>  FIXED SALARY </h3>
            // </th>";
            // echo "</tr>";
            //     echo "<tr>";
            //
            //         echo "<th>BASIC & DA</th>";
            //         echo "<th>HRA</th>";
            //         echo "<th>CONVEYANCE</th>";
            //         echo "<th>ESI</th>";
            //         echo "<th>PF</th>";
            //         echo "<th>TAX</th>";
            //
            //     echo "</tr>";
            // echo "</thead>";
            echo "<tbody>";
            while($row = $result2->fetch_array()){
                echo "<tr>";


                     // echo "<td>" . $row['BASIC_DAA'] . "</td>";
                     // echo "<td>" . $row['HRA'] . "</td>";
                     // echo "<td>" . $row['CONVEYANCE'] . "</td>";
                     // echo "<td>" . $row['ESI'] . "</td>";
                     // echo "<td>" . $row['PF'] . "</td>";
                     // echo "<td>" . $row['TAX'] . "</td>";
                    $_SESSION['EARNING']=$row['BASIC_DAA']+ $row['HRA']+$row['CONVEYANCE'];
                    $DEDUCTION=$row['ESI']+ $row['PF']+$row['TAX'];
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";


        // Free result set
        $result2->free();
    } else{
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
}
if($result = $mysqli->query($sql)){
    if($result->num_rows > 0){
         echo "<table class='table table-bordered table-striped'>";
        //     echo "<thead>";
        //
        //
        //         echo "<tr>";
        //              echo "<th>DATE</th>";
        //              // echo "<th>Eid</th>";
        //              // echo "<th>Name</th>";
        //              // echo "<th>Surname</th>";
        //              echo "<th>Bank Account Number</th>";
        //              echo "<th>EMI</th>";
        //              echo "<th>TOTAL EARNING</th>";
        //              echo "<th>TOTAL DEDUCTION</th>";
        //              echo "<th>NET SALARY</th>";
        //              // echo "<th>View</th>";
        //
        //         echo "</tr>";
        //
        //     echo "</thead>";
        //     echo "<tbody>";
            while($row = $result->fetch_array()){

                echo "<tr>";
                $SID=$row['SID'];
                     // echo "<td>" . $row['pay_date'] . "</td>";
                     // // echo "<td>" . $row['EID'] . "</td>";
                     // // echo "<td>" . $row['FNAME'] . "</td>";
                     // // echo "<td>" . $row['LNAME'] . "</td>";
                     // echo "<td>" . $row['BANK_ACC_NO'] . "</td>";
                     // echo "<td>" . $row['EMI'] . "</td>";


                     $VAR_EMI=$row['EMI'];
                      // echo "<td>" . $row['EARNING'] . "</td>";
                      // echo "<td>" . $EARNING . "</td>";
                      $_SESSION['DEDUCTION']=$DEDUCTION+$VAR_EMI;
                       // echo "<td>" . $row['DEDUCTION'] . "</td>";
                      // echo "<td>" . $DEDUCTION . "</td>";
                      $_SESSION['NET_SALARY']=$_SESSION['EARNING']-$_SESSION['DEDUCTION'];
                      // echo "<td>" . $row['NET_SALARY'] . "</td>";
                      // echo "<td>" . $NET_SALARY . "</td>";




                      // echo "<td>";
                      // echo "<a href='EmpRead.php?EID=". $row['EID'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                      // echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
        // Free result set
        $result->free();
    } else{
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
}


///////////////////////UPDATE///////////////////////////////
$DEDUCTION=$_SESSION['DEDUCTION'];
$EARNING=$_SESSION['EARNING'];
$NET_SALARY=$_SESSION['NET_SALARY'];

// $SID=?
$sql3="UPDATE SALARY SET DEDUCTION=$DEDUCTION,EARNING=$EARNING,NET_SALARY=$NET_SALARY WHERE EID=? AND SID=$SID";

if($result3 = $mysqli->prepare($sql3)){

// ,$param_SID
      $result3->bind_param("i" ,$param_EID);

  // Set parameters

   $param_EID=$EID;
   // $param_SID=$SID;

  // Attempt to execute the prepared statement
  if($result3->execute()){
    // Records updated successfully. Redirect to landing page
    // echo "<script>alert('updated !'); location.href='new.php';</script>";
   header("location:new.php");

    // echo "updated";

    // header("location: AccViewSalary.php");
    // exit();
  } else{
    echo "Something went wrong. Please try again later.";
  }


  $result3->close();
}
///////////////////////////////////////////////////////////////////////



//   $result->close();
// }

// Close statement






//  else{
//     echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
// }

// Close connection
}else {

  // echo "<script>alert('Something went wrong. Please try again later.'); location.href='AccountantLogin.php';</script>";
  header("location: EmpViewSalary.php");








}
$mysqli->close();

?>
