<?php
// Process delete operation after confirmation
if((isset($_POST["EID"]) && !empty($_POST["EID"]))&&(isset($_POST["SID"]) && !empty($_POST["SID"]))){
  // Include config file
  $mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
  if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
  }

  // Prepare a delete statement
  $sql = "DELETE FROM SALARY WHERE EID = ? AND SID=?";

  if($stmt = $mysqli->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("ii", $param_id,$param_SID);

    // Set parameters
    $param_id = trim($_POST["EID"]);
    $param_SID = trim($_POST["SID"]);

    // Attempt to execute the prepared statement
    if($stmt->execute()){
      // Records deleted successfully. Redirect to landing page
      header("location: AccViewSalary.php");
      exit();
    } else{
      echo "Oops! Something went wrong. Please try again later.";
    }
  }

  // Close statement
  $stmt->close();

  // Close connection
  $mysqli->close();
} else{
  // Check existence of id parameter
  if((empty(trim($_GET["EID"])))&& (empty(trim($_GET["SID"])))){
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
  }
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
    color: white;
    background-image: url("https://images.pexels.com/photos/1173987/pexels-photo-1173987.jpeg?cs=srgb&dl=pexels-jesse-yelin-1173987.jpg&fm=jpg");


    text-align:center;
  }
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
            <h1>Delete Record</h1>
          </div>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="alert alert-danger fade in">
              <input type="hidden" name="EID" value="<?php echo trim($_GET["EID"]); ?>"/>
              <input type="hidden" name="SID" value="<?php echo trim($_GET["SID"]); ?>"/>

              <p>Are you sure you want to delete this record?</p><br>
              <p>
                <input type="submit" value="Yes" class="btn btn-danger">
                <a href="AccViewSalary.php" class="btn btn-default">No</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
