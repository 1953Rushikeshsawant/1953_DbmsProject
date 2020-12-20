
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage salary</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
  <style type="text/css">
  body{

    font-family: monospace;
    font-size: 2rem;
    font-weight: bold;
    color: white;
    background-image: url("https://images.pexels.com/photos/1173987/pexels-photo-1173987.jpeg?cs=srgb&dl=pexels-jesse-yelin-1173987.jpg&fm=jpg");
    text-align:center;
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
            <h2 class="pull-left">Employees Details</h2>


          </div>

          <?php
          session_start();
          $mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
          if($mysqli === false){
            die("ERROR: Could not connect. " . $mysqli->connect_error);
          }

          // Attempt select query execution
          $sql = "SELECT * FROM EMPLOYEE,DEPARTMENT WHERE EMPLOYEE.EID=DEPARTMENT.EID";
          if($result = $mysqli->query($sql)){
            if($result->num_rows > 0){

              echo "<table class='table table-bordered table-striped'>";
              echo "<thead>";

              echo "<tr>";
              echo "<th>Eid</th>";
              echo "<th>First Name</th>";
              echo "<th>Last Name</th>";
              echo "<th>City</th>";
              echo "<th>State</th>";
              echo "<th>DOB</th>";
              echo "<th>Email</th>";
              echo "<th>Bank Account Number</th>";
              echo "<th>Gender</th>";
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
                echo "<td>" . $row['BANK_ACC_NO'] . "</td>";
                echo "<td>" . $row['GENDER'] . "</td>";
                echo "<td>" . $row['DEPT_NAME'] . "</td>";
                echo "<td>" . $row['DESIGNATION'] . "</td>";

                echo "</tr>";
                echo "</thead>";

              }

            }
            echo "</tbody>";
            echo "</table>";
            // Free result set
            $result->free();
          } else{
            echo "<p class='lead'><em>No records were found.</em></p>";
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
