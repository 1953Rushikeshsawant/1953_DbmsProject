<!-- // /* Attempt MySQL server connection. Assuming you are running MySQL
// server with default setting (user 'root' with no password) */
// $link = mysqli_connect("localhost", "root", "", "salarymanagementsytem2");
//
// // Check connection
// if($link === false){
//   die("ERROR: Could not connect. " . mysqli_connect_error());
// }
//
// // Attempt select query execution
// $sql = "SELECT * FROM employee";
// if($result = mysqli_query($link, $sql)){
//   if(mysqli_num_rows($result) > 0){
//     echo "<table>";
//     echo "<tr>";
//     echo "<th>Eid</th>";
//     echo "<th>first_name</th>";
//     echo "<th>last_name</th>";
//     echo "<th>City</th>";
//     echo "<th>State</th>";
//     echo "<th>DOB</th>";
//     echo "<th>Email</th>";
//     // echo "<th>password</th>";
//     // echo "<th>Phone No</th>";
//     echo "<th>Bank Acc No</th>";
//     echo "<th>gender</th>";
//     echo "</tr>";
//     while($row = mysqli_fetch_array($result)){
//       echo "<tr>";
//       echo "<td>" . $row['EID'] . "</td>";
//       echo "<td>" . $row['FNAME'] . "</td>";
//       echo "<td>" . $row['LNAME'] . "</td>";
//       echo "<td>" . $row['CITY'] . "</td>";
//       echo "<td>" . $row['STATE'] . "</td>";
//       echo "<td>" . $row['DOB'] . "</td>";
//       echo "<td>" . $row['EMAIL'] . "</td>";
//       // echo "<td>" . $row['PASSWORD'] . "</td>";
//       // echo "<td>" . $row['PHONE_NO'] . "</td>";
//       echo "<td>" . $row['BANK_ACC_NO'] . "</td>";
//       echo "<td>" . $row['GENDER'] . "</td>";
//
//       echo "</tr>";
//     }
//     echo "</table>";
//     // Free result set
//     mysqli_free_result($result);
//   } else{
//     echo "No records matching your query were found.";
//   }
// } else{
//   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }
//
// // Close connection
// mysqli_close($link); -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage salary</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
  <style type="text/css">
  .wrapper{
    width: window.innerwidth;
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
            <h2 class="pull-left">Employees Details</h2>


          </div>

          <?php
          session_start();
          $mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
          if($mysqli === false){
            die("ERROR: Could not connect. " . $mysqli->connect_error);
          }

          // Attempt select query execution
          //$sql = "SELECT * FROM employee";
          $sql = "SELECT * FROM EMPLOYEE,DEPARTMENT WHERE DEPARTMENT.EID=EMPLOYEE.EID";
         if($result = $mysqli->query($sql)){
           if($result->num_rows > 0){

             echo "<table class='table table-bordered table-striped'>";
             echo "<thead>";

             echo "<tr>";
             echo "<th>Eid</th>";
             echo "<th>first_name</th>";
             echo "<th>last_name</th>";
             echo "<th>City</th>";
             echo "<th>State</th>";
             echo "<th>DOB</th>";
             echo "<th>Email</th>";
             // echo "<th>password</th>";
             // echo "<th>Phone No</th>";
             echo "<th>Bank Acc No</th>";
             echo "<th>gender</th>";
             echo "<th>Department</th>";
             echo "<th>Designation</th>";


             echo "</tr>";
             while($row = $result->fetch_array()){
               echo "<tr>";
               echo "<td>" . $row['EID'] . "</td>";
               echo "<td>" . $row['FNAME'] . "</td>";
               echo "<td>" . $row['LNAME'] . "</td>";
               echo "<td>" . $row['CITY'] . "</td>";
               echo "<td>" . $row['STATE'] . "</td>";
               echo "<td>" . $row['DOB'] . "</td>";
               echo "<td>" . $row['EMAIL'] . "</td>";
               // echo "<td>" . $row['PASSWORD'] . "</td>";
               // echo "<td>" . $row['PHONE_NO'] . "</td>";
               echo "<td>" . $row['BANK_ACC_NO'] . "</td>";
               echo "<td>" . $row['GENDER'] . "</td>";
               echo "<td>" . $row['DEPT_NAME'] . "</td>";
               echo "<td>" . $row['DESIGNATION'] . "</td>";


               echo "</tr>";
               echo "</thead>";

             }

                // // echo "<td>";
                // // echo "<a href='read.php?EID=". $row['EID'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                // //  echo "<a href='update.php?EID=". $row['EID'] ."&SID=".$row['SID']."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                // //
                // // // echo "<a href='update.php?EID=".$row['EID']."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                // // echo "<a href='delete.php?EID=". $row['EID'] ."&SID=".$row['SID']."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                // //
                // // // echo "<a href='delete.php?EID=". $row['EID'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                // // echo "</td>";
                // echo "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
              // Free result set
              $result->free();
            } else{
              echo "<p class='lead'><em>No records were found.</em></p>";
            }
          //  else{
          //   echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
          // }

          // Close connection
          $mysqli->close();

          ?>
        </div>
      </div>
    </div>
    <a href="AddSalary.html" class="btn btn-primary pull-right">Back</a>

  </div>

</body>
</html>
