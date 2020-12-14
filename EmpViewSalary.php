<!--
// session_start();
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "salarymanagementsystem";
//
// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

//WORKING
// $sql = "SELECT s.SID, s.EMI, s.DEDUCTION,s.EARNING,s.NET_SALARY,fs.BASIC_DAA,fs.HRA,fs.ESI,fs.CONVEYANCE,fs.PF,fs.TAX
// FROM SALARY s
// JOIN FIXED_SALARY fs
// ON s.SID =fs.FID  " ;


//NOT WORKING
// $sql="SELECT s.SID, s.EMI, s.DEDUCTION,s.EARNING,s.NET_SALARY
//     , fs.BASIC_DAA,fs.HRA,fs.ESI,fs.CONVEYANCE,fs.PF,fs.TAX
// FROM SALARY s
// INNER JOIN FIXED_SALARY fs
//     on s.SID = fs.FIXED_SALARY
// INNER JOIN EMPLOYEE e
//     on fs.FID = e.EID;"
//

// $sql="SELECT EMPLOYEE.FNAME,
//        EMPLOYEE.LNAME,
//        SALARY.EMI,
//        SALARY.DEDUCTION,
//        IS_PAID.EID
//   FROM IS_PAID
//  INNER JOIN EMPLOYEE ON EMPLOYEE.EID = IS_PAID.EID
//  INNER JOIN SALARY ON SALARY.SID = IS_PAID.SID";
//
// $result = $conn->query($sql);
//
// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     // echo "Sid: " . $row["SID"]. " - EMI: " . $row["EMI"]. " " . $row["DEDUCTION"]." " . $row["EARNING"]." " . $row["NET_SALARY"]." ". $row["BASIC_DAA"]." " .$row["HRA"]." " .$row["ESI"]. " " .$row["CONVEYANCE"]. " " .$row["PF"]. " " .$row["TAX"]."<br>";
//
// echo " ".$row["FNAME"]."  ".$row["LNAME"]."  ".$row["EMI"]."  ".$row["DEDUCTION"]."  ".$row["EID"]. "<br />";
//   }
// } else {
//   echo "0 results";
// }
// $conn->close(); -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
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
                    session_start();
                    $_session=$EID;
                    $mysqli = new mysqli("localhost", "root", "", "salarymanagementsystem");
                    if($mysqli === false){
                        die("ERROR: Could not connect. " . $mysqli->connect_error);
                    }

                    // Attempt select query execution
                     //$sql = "SELECT * FROM employee";
                     $sql="SELECT * FROM SALARY,EMPLOYEE WHERE SALARY.SID=EMPLOYEE.EID  AND EID=";

                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                         echo "<th>EID</th>";
                                         echo "<th>FNAME</th>";
                                         echo "<th>LNAME</th>";
                                        // echo "<th>CITY</th>";
                                        // echo "<th>STATE</th>";
                                        // echo "<th>DOB</th>";
                                        // echo "<th>EMAIL</th>";
                                        // echo "<th>PASSWORD</th>";
                                        // echo "<th>PHONE_NO</th>";
                                         echo "<th>BANK_ACC_NO</th>";
                                        // echo "<th>GENDER</th>";

                                        // echo "<th>EMI</th>";
                                        // echo "<th>BASIC & DA</th>";
                                        // echo "<th>HRA</th>";
                                        // echo "<th>CONVEYANCE</th>";
                                        // echo "<th>ESI</th>";
                                        // echo "<th>PF</th>";
                                        // echo "<th>TAX</th>";

                                         echo "<th>TOTAL EARNING</th>";
                                         echo "<th>TOTAL DEDUCTION</th>";
                                         echo "<th>NET SALARY</th>";

                                        echo "<th>ACTION</th>";



                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";

                                         echo "<td>" . $row['EID'] . "</td>";
                                         echo "<td>" . $row['FNAME'] . "</td>";
                                         echo "<td>" . $row['LNAME'] . "</td>";
                                        // echo "<td>" . $row['CITY'] . "</td>";
                                        // echo "<td>" . $row['STATE'] . "</td>";
                                        // echo "<td>" . $row['DOB'] . "</td>";
                                        // echo "<td>" . $row['EMAIL'] . "</td>";
                                        // echo "<td>" . $row['PASSWORD'] . "</td>";
                                        // echo "<td>" . $row['PHONE_NO'] . "</td>";
                                         echo "<td>" . $row['BANK_ACC_NO'] . "</td>";
                                        // echo "<td>" . $row['GENDER'] . "</td>";


                                         // echo "<td>" . $row['EMI'] . "</td>";
                                         // echo "<td>" . $row['BASIC_DAA'] . "</td>";
                                         // echo "<td>" . $row['HRA'] . "</td>";
                                         // echo "<td>" . $row['CONVEYANCE'] . "</td>";
                                         // echo "<td>" . $row['ESI'] . "</td>";
                                         // echo "<td>" . $row['PF'] . "</td>";
                                         // echo "<td>" . $row['TAX'] . "</td>";

                                          echo "<td>" . $row['EARNING'] . "</td>";
                                          echo "<td>" . $row['DEDUCTION'] . "</td>";
                                          echo "<td>" . $row['NET_SALARY'] . "</td>";


                                         echo "<td>";
                                             echo "<a href='read.php?EID=". $row['EID'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                             echo "<a href='update.php?EID=". $row['EID'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                             echo "<a href='delete.php?EID=". $row['EID'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                         echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }

                    // Close connection
                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
