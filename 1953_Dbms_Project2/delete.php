<?php
// Process delete operation after confirmation
session_start();
$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");
if($mysqli === false){
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// if(isset($_POST["EID"]) && !empty($_POST["EID"])){
if((isset($_POST["EID"]) && !empty($_POST["EID"])) && (isset($_POST["SID"]) && !empty($_POST["SID"]))){

    $EID = $_POST["EID"];
    $SID=$_POST["SID"];

    // Prepare a delete statement
    $sql = "DELETE FROM SALARY WHERE EID = ? AND SID= ?";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ii", $param_EID,$param_SID);

        // Set parameters
        $param_EID = trim($_POST["EID"]);
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
    // Check existence of EID parameter
    if((empty(trim($_GET["EID"])))&& (empty(trim($_GET["SID"])))){
    // if((isset($_GET["EID"]) && !empty(trim($_GET["EID"]))) && (isset($_GET["SID"]) && !empty(trim($_GET["SID"])))){

      $EID =  trim($_GET["EID"]);
      $SID =  trim($_GET["SID"]);

      ////////////////////////////////////






////////////////////////////////////////////////////


        // URL doesn't contain EID parameter. Redirect to error page
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
        .wrapper{
            wEIDth: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluEID">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                          <input type="hidden" name="EID" value="<?php echo $EID; ?>"/>
                          <input type="hidden" name="SID" value="<?php echo $SID; ?>"/>
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
