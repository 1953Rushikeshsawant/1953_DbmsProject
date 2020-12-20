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

        $BASIC_DAA=$row['BASIC_DAA'] ;
        $HRA= $row['HRA'] ;
        $CONVEYANCE=$row['CONVEYANCE'] ;
        $ESI= $row['ESI'];
        $PF= $row['PF'] ;
        $TAX=$row['TAX'] ;

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
  body{

    font-family: monospace;
    font-size: 2rem;
    font-weight: bold;
    color: black;
    background-image: url("https://images.pexels.com/photos/1173987/pexels-photo-1173987.jpeg?cs=srgb&dl=pexels-jesse-yelin-1173987.jpg&fm=jpg");
    text-align:center;
    padding-bottom: 5rem;
    padding-top: 1rem;

  }

  h1 {
    padding-bottom: 2rem;
  }

  h2 {
    padding-bottom: 2rem;
    text-decoration: underline;
    font-size: 4rem;

  }
  p{
    color:white;
    font-weight: bold ;
    text-decoration: underline;
  }
  .wrapper{
    width: 500px;
    margin: 0 auto;
    border-style: solid ;
    border-color: white;
    border-width: 10px;

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

          <p><a href="AccViewSalary.php" class="btn btn-primary">Back</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
