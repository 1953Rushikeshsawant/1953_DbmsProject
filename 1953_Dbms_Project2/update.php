<?php
 session_start();
// Include config file
$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
if($mysqli === false){
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}
// Define variables and initialize with empty values
$EMI=$PAY_DATE="";
$EMI_ERR =$PAY_DATE_ERR="";

// Processing form data when form is submitted
if((isset($_POST["EID"]) && !empty($_POST["EID"])) && (isset($_POST["SID"]) && !empty($_POST["SID"]))){

  // Get hidden input value
  $EID = $_POST["EID"];
  $SID=$_POST["SID"];

  // Validate
  $input_emi = trim($_POST["EMI"]);
  {
    $EMI = $input_emi;
  }
  $input_PAY_DATE = trim($_POST["PAY_DATE"]);
  {
    $PAY_DATE = $input_PAY_DATE;
  }

  // Check input errors before inserting in database
  if( empty($EMI_ERR) && empty($PAY_DATE_ERR) ){
    // Prepare an update statement
    $sql = "UPDATE SALARY SET EMI=? ,pay_date=? WHERE EID=? AND SID=?";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("ssii",$param_EMI,$param_PAY_DATE, $param_EID,$param_SID);

      // Set parameters
      $param_EMI = $EMI;
      $param_PAY_DATE = $PAY_DATE;

       $param_EID=$EID;
        $param_SID=$SID;


      // Attempt to execute the prepared statement
      if($stmt->execute()){
        // Records updated successfully. Redirect to landing page
        // echo "<script>alert('updated !'); location.href='AccViewSalary.php';</script>";

        header("location: AccViewSalary.php");
        exit();
      } else{
        echo "Something went wrong. Please try again later.";
      }

    }

    // Close statement
    $stmt->close();

 }

  // Close connection
    $mysqli->close();
 } else{
   // Check existence of id parameter before processing further
   if((isset($_GET["EID"]) && !empty(trim($_GET["EID"]))) && (isset($_GET["SID"]) && !empty(trim($_GET["SID"])))){

     // Get URL parameter
     $EID =  trim($_GET["EID"]);
     $SID =  trim($_GET["SID"]);


     // Prepare a select statement
     $sql = "SELECT * FROM SALARY WHERE EID = ? AND SID=?";
     if($stmt = $mysqli->prepare($sql)){
       // Bind variables to the prepared statement as parameters
       $stmt->bind_param("ii", $param_EID,$param_SID);

       // Set parameters
       $param_EID = $EID;
       $param_SID=$SID;

       // Attempt to execute the prepared statement
       if($stmt->execute()){
         $result = $stmt->get_result();

         if($result->num_rows == 1){
           /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
           $row = $result->fetch_array(MYSQLI_ASSOC);

           // Retrieve individual field value

           $EMI = $row["EMI"];
            $PAY_DATE = $row["pay_date"];

        } else{
           // URL doesn't contain valid id. Redirect to error page
           // header("location: error.php");
           echo "<script>alert('URL doesn't contain valid id.!'); location.href='AccViewSalary.php';</script>";
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

  }  else{
    // URL doesn't contain id parameter. Redirect to error page
    // header("location: error.php");
    echo "<script>alert('URL doesn't contain id parameter.!'); location.href='AccViewSalary.php';</script>";

    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Record</title>
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
  h1 {
    padding-bottom: 2rem;
  }

  h2 {
    padding-bottom: 2rem;
    text-decoration: underline;
    font-size: 4rem;

  }
  p{
    color:black;
    font-weight: bolder;
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
            <h2>Update Salary</h2>
          </div>
          <p>Please edit the input values and submit to update the Salary.</p>
          <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <div class="form-group <?php echo (!empty($EMI_ERR)) ? 'has-error' : ''; ?>">
              <label>EMI</label>
              <input type="text" name="EMI" class="form-control" value="<?php echo $EMI; ?>" required>
              <span class="help-block"><?php echo $EMI_ERR;?></span>
            </div>

            <div class=""form-group <?php echo (!empty($PAY_DATE_ERR)) ? 'has-error' : ''; ?>"">
            <label>DATE</label>
            <input type="date" name="PAY_DATE" class="form-control" value="<?php echo $PAY_DATE; ?>" required>
            <span class="help-block"><?php echo $PAY_DATE_ERR;?></span>
          </div>

            <input type="hidden" name="EID" value="<?php echo $EID; ?>"/>
            <input type="hidden" name="SID" value="<?php echo $SID; ?>"/>

            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="AccViewSalary.php" class="btn btn-default">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
