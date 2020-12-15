<?php
session_start();
// Include config file
$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
if($mysqli === false){
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}
// Define variables and initialize with empty values
$BASIC_DA = $EMI=$HRA = $PF = $ESI=$TAX=$CONVEYANCE=$DEDUCTION=$EARNING=$NET_SALARY=$SID="";
$BASIC_DA_ERR = $EMI_ERR = $HRA_ERR=$PF_ERR = $ESI_ERR=$TAX_ERR=$CONVEYANCE_ERR=$DEDUCTION_ERR=$EARNING_ERR=$NET_SALARY_ERR="";


// Processing form data when form is submitted
if(isset($_POST["EID"]) && !empty($_POST["EID"])){
  // Get hidden input value
  $SID = $_POST["EID"];

  // Validate name
  $input_emi = trim($_POST["EMI"]);
  {
    $EMI = $input_emi;
  }

  //Validate
  $input_basic_da = trim($_POST["BASIC_DA"]);
  if(empty($input_basic_da)){
    $BASIC_DA_ERR = "Please enter an BASIC SALARY.";
  } else{
    $BASIC_DA = $input_basic_da;
  }


  // Validate
  $input_earning = trim($_POST["EARNING"]);
  if(empty($input_earning)){
    $EARNING_ERR = "Please enter the EARNING amount.";
  } else{
    $EARNING = $input_earning;
  }


  $input_net_salary = trim($_POST["NET_SALARY"]);
  if(empty($input_net_salary)){
    $NET_SALARY_ERR = "Please enter the NET SALARY.";
  } else{
    $NET_SALARY = $input_net_salary;
  }


  $input_deduction = trim($_POST["DEDUCTION"]);
  if(empty($input_deduction)){
    $DEDUCTION_ERR = "Please enter the DEDUCTION amount.";
  } else{
    $DEDUCTION = $input_deduction;
  }

  $input_conveyance = trim($_POST["CONVEYANCE"]);
  if(empty($input_conveyance)){
    $CONVEYANCE_ERR = "Please enter the CONVEYANCE amount.";
  }  else{
    $CONVEYANCE = $input_conveyance;
  }

  $input_esi = trim($_POST["ESI"]);
  if(empty($input_esi)){
    $ESI_ERR = "Please enter the ESI amount.";
  }  else{
    $ESI = $input_esi;
  }

  $input_pf = trim($_POST["PF"]);
  if(empty($input_pf)){
    $PF_ERR = "Please enter the PF amount.";
  }  else{
    $PF = $input_pf;
  }

  $input_tax = trim($_POST["TAX"]);
  if(empty($input_tax)){
    $TAX_ERR = "Please enter the TAX amount.";
  }  else{
    $TAX = $input_tax;
  }

  $input_hra = trim($_POST["HRA"]);
  if(empty($input_hra)){
    $HRA_ERR = "Please enter the HRA amount.";
  }  else{
    $HRA = $input_hra;
  }

  // Check input errors before inserting in database


  if(empty($BASIC_DA_ERR) && empty($EMI_ERR) && empty($PF_ERR)&& empty($ESI_ERR)&& empty($TAX_ERR)&& empty($CONVEYANCE_ERR)&& empty($DEDUCTION_ERR)&& empty($EARNING_ERR)&& empty($NET_SALARY_ERR)&& empty($HRA_ERR)){
    // Prepare an update statement
    $sql = "UPDATE SALARY SET EMI=?, DEDUCTION=?, EARNING=? ,NET_SALARY=?,BASIC_DAA=?,HRA=?,CONVEYANCE=?,ESI=?,PF=?, TAX=? WHERE SID=?";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("ssssssssssi", $param_EMI, $param_DEDUCTION, $param_EARNING,$param_NET_SALARY,$param_BASIC_DA,$param_HRA,$param_CONVEYANCE,$param_ESI,$param_PF,$param_TAX, $param_SID);

      // Set parameters
      $param_EMI = $EMI;
      $param_DEDUCTION = $DEDUCTION;
      $param_EARNING = $EARNING;
      $param_NET_SALARY = $NET_SALARY;
      $param_BASIC_DA=$BASIC_DA;
      $param_HRA=$HRA;
      $param_CONVEYANCE=$CONVEYANCE;
      $param_ESI=$ESI;
      $param_PF=$PF;
      $param_TAX=$TAX;
      $param_SID=$EID;


      // Attempt to execute the prepared statement
      if($stmt->execute()){
        // Records updated successfully. Redirect to landing page
        echo "<script>alert('updated !'); location.href='AccViewSalary.php';</script>";

        // header("location: AccViewSalary.php");
        exit();
      } else{
        echo "Something went wrong. Please try again later.";
      }
      $stmt->close();
    }

    // Close statement

  }

  // Close connection
  $mysqli->close();
} else{
  // Check existence of id parameter before processing further
  if(isset($_GET["EID"]) && !empty(trim($_GET["EID"]))){
    // Get URL parameter
    $SID =  trim($_GET["EID"]);

    // Prepare a select statement
    $sql = "SELECT * FROM SALARY WHERE SID = ?";
    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("i", $param_SID);

      // Set parameters
      $param_SID = $SID;

      // Attempt to execute the prepared statement
      if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows == 1){
          /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
          $row = $result->fetch_array(MYSQLI_ASSOC);

          // Retrieve individual field value

          $EMI = $row["EMI"];
          $DEDUCTION = $row["DEDUCTION"];
          $EARNING = $row["EARNING"];
          $NET_SALARY = $row["NET_SALARY"];
          $BASIC_DA = $row["BASIC_DAA"];
          $HRA=$row["HRA"];
          $CONVEYANCE = $row["CONVEYANCE"];
          $ESI = $row["ESI"];
          $PF = $row["PF"];
          $TAX = $row["TAX"];

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
  <title>Update Record</title>
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
            <h2>Update Record</h2>
          </div>
          <p>Please edit the input values and submit to update the record.</p>
          <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <div class="form-group <?php echo (!empty($EMI_ERR)) ? 'has-error' : ''; ?>">
              <label>EMI</label>
              <input type="text" name="EMI" class="form-control" value="<?php echo $EMI; ?>">
              <span class="help-block"><?php echo $EMI_ERR;?></span>
            </div>
            <div class="form-group <?php echo (!empty($BASIC_DA_ERR)) ? 'has-error' : ''; ?>">
              <label>BASIC & DAA</label>
              <input type="text" name="BASIC_DA" class="form-control" value="<?php echo $BASIC_DA; ?>">
              <span class="help-block"><?php echo $BASIC_DA_ERR;?></span>
            </div>
            <div class="form-group <?php echo (!empty($HRA_ERR)) ? 'has-error' : ''; ?>">
              <label>HRA</label>
              <input type="text" name="HRA" class="form-control" value="<?php echo $HRA; ?>">
              <span class="help-block"><?php echo $HRA_ERR;?></span>
            </div>


            <div class="form-group <?php echo (!empty($CONVEYANCE_ERR)) ? 'has-error' : ''; ?>">
              <label>CONVEYANCE</label>
              <input type="text" name="CONVEYANCE" class="form-control" value="<?php echo $CONVEYANCE; ?>">
              <span class="help-block"><?php echo $CONVEYANCE_ERR;?></span>
            </div>
            <div class="form-group <?php echo (!empty($ESI_ERR)) ? 'has-error' : ''; ?>">
              <label>ESI</label>
              <input type="text" name="ESI" class="form-control" value="<?php echo $ESI; ?>">
              <span class="help-block"><?php echo $ESI_ERR;?></span>
            </div>
            <div class="form-group <?php echo (!empty($PF_ERR)) ? 'has-error' : ''; ?>">
              <label>PF</label>
              <input type="text" name="PF" class="form-control" value="<?php echo $PF; ?>">
              <span class="help-block"><?php echo $PF_ERR;?></span>
            </div>
            <div class="form-group <?php echo (!empty($TAX_ERR)) ? 'has-error' : ''; ?>">
              <label>TAX</label>
              <input type="text" name="TAX" class="form-control" value="<?php echo $TAX; ?>">
              <span class="help-block"><?php echo $TAX_ERR;?></span>
            </div>
            <div class="form-group <?php echo (!empty($EARNING_ERR)) ? 'has-error' : ''; ?>">
              <label>TOTAL EARNING</label>
              <input type="text" name="EARNING" class="form-control" value="<?php echo $EARNING; ?>">
              <span class="help-block"><?php echo $EARNING_ERR;?></span>
            </div>

            <div class="form-group <?php echo (!empty($DEDUCTION_ERR)) ? 'has-error' : ''; ?>">
              <label>TOTAL DEDUCTION</label>
              <input type="text" name="DEDUCTION" class="form-control" value="<?php echo $DEDUCTION; ?>">
              <span class="help-block"><?php echo $DEDUCTION_ERR;?></span>
            </div>

            <div class="form-group <?php echo (!empty($NET_SALARY_ERR)) ? 'has-error' : ''; ?>">
              <label>NET SALARY</label>
              <input type="text" name="NET_SALARY" class="form-control" value="<?php echo $NET_SALARY; ?>">
              <span class="help-block"><?php echo $NET_SALARY_ERR;?></span>
            </div>


            <input type="hidden" name="EID" value="<?php echo $EID; ?>"/>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="AccViewSalary.php" class="btn btn-default">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
