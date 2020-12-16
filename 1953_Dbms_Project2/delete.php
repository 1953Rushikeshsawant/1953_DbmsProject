<?php
// Process delete operation after confirmation
  // Include config file
  $mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
  if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
  }



  $PAY_DATE="";
  $PAY_DATE_ERR="";

  if(isset($_POST["EID"]) && !empty($_POST["EID"])){

    $EID=$_POST["EID"];

    $input_PAY_DATE = trim($_POST["PAY_DATE"]);
    {
      $PAY_DATE = $input_PAY_DATE;
    }
    if( empty($PAY_DATE_ERR) ){

      // Prepare a delete statement
      $sql = "DELETE FROM SALARY WHERE EID = ? AND pay_date= ? ";

      if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("si",$PAY_DATE, $param_EID);

        // Set parameters
        $param_PAY_DATE=$PAY_DATE;
        $param_EID = $EID;

        // Attempt to execute the prepared statement
        if($stmt->execute()){
          // Records deleted successfully. Redirect to landing page
          // header("location: AccViewSalary.php");
          echo "<script>alert('Record deleted !'); location.href='AccViewSalary.php';</script>";

          exit();
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }
      }

      // Close statement
      $stmt->close();
}
      // Close connection
      $mysqli->close();
    } else{
      // Check existence of id parameter before processing further
      if(isset($_GET["EID"]) && !empty(trim($_GET["EID"]))){
        // Get URL parameter
        $EID =  trim($_GET["EID"]);

        // Prepare a select statement
        $sql = "SELECT * FROM SALARY WHERE EID = ?";
        if($stmt = $mysqli->prepare($sql)){
          // Bind variables to the prepared statement as parameters
          $stmt->bind_param("i", $param_EID);

          // Set parameters
          $param_EID = $EID;

          // Attempt to execute the prepared statement
          if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows == 1){
              /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
              $row = $result->fetch_array(MYSQLI_ASSOC);

              // Retrieve individual field value

              $PAY_DATE = $row["pay_date"];
              //           $DEDUCTION = $row["DEDUCTION"];
              //           $EARNING = $row["EARNING"];
              //           $NET_SALARY = $row["NET_SALARY"];
              //           $BASIC_DA = $row["BASIC_DAA"];
              //           $HRA=$row["HRA"];
              //           $CONVEYANCE = $row["CONVEYANCE"];
              //           $ESI = $row["ESI"];
              //           $PF = $row["PF"];
              //           $TAX = $row["TAX"];
              //
            } else{
              // URL doesn't contain valid id. Redirect to error page
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

      }  else{
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
      <title>Delete Record</title>
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
                <h1>Delete Record</h1>
              </div>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class=""form-group <?php echo (!empty($PAY_DATE_ERR)) ? 'has-error' : ''; ?>"">
                  <label>DATE</label>
                  <input type="date" name="PAY_DATE" class="form-control" value="<?php echo $PAY_DATE; ?>" >
                  <span class="help-block"><?php echo $PAY_DATE_ERR;?></span>
                </div>
                <div class="alert alert-danger fade in">
                  <input type="hidden" name="id" value="<?php echo trim($_GET["EID"]); ?>"/>
                  <p>Are you sure you want to delete this record?</p><br>
                  <p>
                    <input type="submit" value="Yes" class="btn btn-danger">
                    <a href="index.php" class="btn btn-default">No</a>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </body>
    </html>
