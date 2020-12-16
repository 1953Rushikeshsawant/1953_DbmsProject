<?php
session_start();
// Check existence of id parameter before processing further
if(isset($_GET["EID"]) && !empty(trim($_GET["EID"]))){
  // Include config file
  $mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
  if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
  }

  // Prepare a select statement  FIXED SALARY AND SALARY
  // $sql = "SELECT * FROM SALARY WHERE EID = ?";

  $sql2= "SELECT * FROM DEPARTMENT,FIXED_SALARY WHERE EID=? AND DEPARTMENT.FID=FIXED_SALARY.FID ";

  if($stmt = $mysqli->prepare($sql2) ){

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_id);

    // Set parameters

    $param_id = trim($_GET["EID"]);

    // Attempt to execute the prepared statement
    if($stmt->execute()){
      $result = $stmt->get_result();

      if($result->num_rows == 1){
        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
        $row = $result->fetch_array(MYSQLI_ASSOC);

        // Retrieve individual field value


      //  $EMI=$row['EMI'] ;
        $BASIC_DAA=$row['BASIC_DAA'] ;
        $HRA= $row['HRA'] ;
        $CONVEYANCE=$row['CONVEYANCE'] ;
        $ESI= $row['ESI'];
        $PF= $row['PF'] ;
        $TAX=$row['TAX'] ;

        // $EARNING= $row['EARNING'] ;
        // $DEDUCTION=$row['DEDUCTION'] ;
        // $NET_SALARY= $row['NET_SALARY'] ;
      } else{
        // URL doesn't contain valid id parameter. Redirect to error page
        header("location: error.php");
        exit();
      }

    } else{
      echo "Oops! Something went wrong. Please try again later.";
    }
    // Close statement
    $stmt->close();
  }



  // Close connection
  $mysqli->close();
} else{
  // URL doesn't contain id parameter. Redirect to error page
  header("location: error.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Record</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
  .wrapper{
    width: 500px;
    margin: 0 auto;
  }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1>View SALARY</h1>
          </div>
          <!-- <div class="form-group">
            <label>EMI</label>
            <p class="form-control-static"><?php echo $row["EMI"]; ?></p>
          </div> -->
          <div class="form-group">
            <label>BASIC_DAA</label>
            <p class="form-control-static"><?php echo $row["BASIC_DAA"]; ?></p>
          </div>
          <div class="form-group">
            <label>HRA</label>
            <p class="form-control-static"><?php echo $row["HRA"]; ?></p>
          </div>
          <div class="form-group">
            <label>CONVEYANCE</label>
            <p class="form-control-static"><?php echo $row["CONVEYANCE"]; ?></p>
          </div>
          <div class="form-group">
            <label>ESI</label>
            <p class="form-control-static"><?php echo $row["ESI"]; ?></p>
          </div>
          <div class="form-group">
            <label>PF</label>
            <p class="form-control-static"><?php echo $row["PF"]; ?></p>
          </div>
          <div class="form-group">
            <label>TAX</label>
            <p class="form-control-static"><?php echo $row["TAX"]; ?></p>
          </div>
          <!-- <div class="form-group">
            <label>DEDUCTION</label>
            <p class="form-control-static"><?php echo $row["DEDUCTION"]; ?></p>
          </div>
          <div class="form-group">
            <label>EARNING</label>
            <p class="form-control-static"><?php echo $row["EARNING"]; ?></p>
          </div>
          <div class="form-group">
            <label>NET SALARY</label>
            <p class="form-control-static"><?php echo $row["NET_SALARY"]; ?></p>
          </div> -->
          <p><a href="AccViewSalary.php" class="btn btn-primary">Back</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
