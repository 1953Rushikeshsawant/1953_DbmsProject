<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage salary</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
  <!-- <style type="text/css">
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
</style> -->
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
            <h2 class="pull-left">Employees Salary</h2>

            <a href="AddSalary.html" class="btn btn-success btn-lg ">Add New Salary</a>

          </div>

          <?php
          $mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
          if($mysqli === false){
            die("ERROR: Could not connect. " . $mysqli->connect_error);
          }

          // Attempt select query execution
          $sql="SELECT * FROM SALARY,EMPLOYEE WHERE SALARY.EID=EMPLOYEE.EID";

          if($result = $mysqli->query($sql)){
            if($result->num_rows > 0){
              echo "<table class='table table-bordered table-striped'>";
              echo "<thead>";
              echo "<tr>";

              echo "<th>EID</th>";
              echo "<th>FNAME</th>";
              echo "<th>LNAME</th>";
              echo "<th>BANK_ACC_NO</th>";
              echo "<th>EMI</th>";
              echo "<th>TOTAL EARNING</th>";
              echo "<th>TOTAL DEDUCTION</th>";
              echo "<th>NET SALARY</th>";
              echo "<th>PAYMENT DATE</th>";
              echo "<th>SID</th>";
              echo "<th>ACTION</th>";

              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              while($row = $result->fetch_array()){
                echo "<tr>";

                echo "<td>" . $row['EID'] . "</td>";
                echo "<td>" . $row['FNAME'] . "</td>";
                echo "<td>" . $row['LNAME'] . "</td>";
                echo "<td>" . $row['BANK_ACC_NO'] . "</td>";
                echo "<td>" . $row['EMI'] . "</td>";

                echo "<td>" . $row['EARNING'] . "</td>";
                echo "<td>" . $row['DEDUCTION'] . "</td>";
                echo "<td>" . $row['NET_SALARY'] . "</td>";
                echo "<td>" . $row['pay_date'] . "</td>";
                echo "<td>" . $row['SID'] . "</td>";

                echo "<td>";

                echo "<a href='read.php?EID=". $row['EID'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                echo "<a href='update.php?EID=". $row['EID'] ."&SID=".$row['SID']."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                echo "<a href='delete.php?EID=". $row['EID'] ."&SID=".$row['SID']."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
    <a href="AddSalary.html" class="btn btn-primary ">Back</a>

  </div>

</body>
</html>
