<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Salary</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
    body {
      font: 14px sans-serif;
      padding-bottom: 5rem;
      font-family: monospace;
      font-size: 2rem;
      color: white;
      text-align: center;
      background-image: url("https://images.pexels.com/photos/1173987/pexels-photo-1173987.jpeg?cs=srgb&dl=pexels-jesse-yelin-1173987.jpg&fm=jpg");
    }
    td{
      color: black;
    }
    tr
    {
      background-color:white;
      color:black;
    }
        .wrapper{
          width: window.innerwidth;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child {
            margin-right: 15px;
        }
        strong{
          font-size: 2.5rem;

        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Salary Details</h2>
                    </div>

                    <?php
                    // session_start();
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


                     echo "<th>
                     <h3>  FIXED SALARY</h3>
                     </th>";
//////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////
                    if($result2 = $mysqli->query($sql2)){
                        if($result2->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";

                                echo "</tr>";
                                    echo "<tr>";

                                        echo "<th>BASIC & DA</th>";
                                        echo "<th>HRA</th>";
                                        echo "<th>CONVEYANCE</th>";
                                        echo "<th>ESI</th>";
                                        echo "<th>PF</th>";
                                        echo "<th>TAX</th>";

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result2->fetch_array()){
                                    echo "<tr>";


                                         echo "<td>" . $row['BASIC_DAA'] . "</td>";
                                         echo "<td>" . $row['HRA'] . "</td>";
                                         echo "<td>" . $row['CONVEYANCE'] . "</td>";
                                         echo "<td>" . $row['ESI'] . "</td>";
                                         echo "<td>" . $row['PF'] . "</td>";
                                         echo "<td>" . $row['TAX'] . "</td>";

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

                    echo "<th>
                    <h3>  Your Salaries </h3>
                    </th>";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";


                                    echo "<tr>";
                                         echo "<th>DATE</th>";
                                         // echo "<th>Eid</th>";
                                         // echo "<th>Name</th>";
                                         // echo "<th>Surname</th>";
                                         echo "<th>Bank Account Number</th>";
                                         echo "<th>EMI</th>";
                                         echo "<th>TOTAL EARNING</th>";
                                         echo "<th>TOTAL DEDUCTION</th>";
                                         echo "<th>NET SALARY</th>";
                                         // echo "<th>View</th>";

                                    echo "</tr>";

                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){

                                    echo "<tr>";
                                    $SID=$row['SID'];
                                         echo "<td>" . $row['pay_date'] . "</td>";
                                         // echo "<td>" . $row['EID'] . "</td>";
                                         // echo "<td>" . $row['FNAME'] . "</td>";
                                         // echo "<td>" . $row['LNAME'] . "</td>";
                                         echo "<td>" . $row['BANK_ACC_NO'] . "</td>";
                                         echo "<td>" . $row['EMI'] . "</td>";


                                         // $VAR_EMI=$row['EMI'];
                                          echo "<td>" . $row['EARNING'] . "</td>";
                                          // echo "<td>" . $EARNING . "</td>";
                                          // $_SESSION['DEDUCTION']=$DEDUCTION+$VAR_EMI;
                                           echo "<td>" . $row['DEDUCTION'] . "</td>";
                                          // echo "<td>" . $DEDUCTION . "</td>";
                                          // $_SESSION['NET_SALARY']=$EARNING-$DEDUCTION;
                                          echo "<td><strong>" . $row['NET_SALARY'] . "</strong></td>";
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


                    //   $result->close();
                    // }

                    // Close statement






                    //  else{
                    //     echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    // }

                    // Close connection
                    $mysqli->close();
           
                    ?>

                    <a href="AddEmployee.html" class="btn btn-primary">Back</a>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
