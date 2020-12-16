<?php
$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");


if($mysqli === false){
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}



// Define variables and initialize with empty values
$ACC_EMAIL = $ACC_PASSWORD = $CONFIRM_PASSWORD = "";
$ACC_EMAIL_ERR = $ACC_PASSWORD_ERR = $CONFIRM_PASSWORD_ERR = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Validate username
  if(empty(trim($_POST["ACC_EMAIL"]))){
    $ACC_EMAIL_ERR = "Please enter a username.";
    echo "<script>alert('Please enter a username!'); location.href='AccountantSignUp.html';</script>";


  } else{
    // Prepare a select statement
    $sql = "SELECT ACC_ID FROM ACCOUNTANT_DETAILS WHERE ACC_EMAIL = ?";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_username);

      // Set parameters
      $param_username = trim($_POST["ACC_EMAIL"]);

      // Attempt to execute the prepared statement
      if($stmt->execute()){
        /* store result */
        $stmt->store_result();

        if($stmt->num_rows == 1){
          $ACC_EMAIL_ERR = "This username is already taken.";
          echo "<script>alert('This username is already taken.!'); location.href='AccountantSignUp.html';</script>";

        } else{
          $ACC_EMAIL = trim($_POST["ACC_EMAIL"]);
        }
      } else{
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  // Validate password
  if(empty(trim($_POST["ACC_PASSWORD"]))){
    $ACC_PASSWORD_ERR = "Please enter a password.";
    echo "<script>alert('Please enter password !'); location.href='AccountantSignUp.html';</script>";

  } elseif(strlen(trim($_POST["ACC_PASSWORD"])) < 6){
    $ACC_PASSWORD_ERR = "Password must have atleast 6 characters.";
    echo "<script>alert('Password must have atleast 6 characters.!'); location.href='AccountantSignUp.html';</script>";

  } else{
    $ACC_PASSWORD = trim($_POST["ACC_PASSWORD"]);
  }

  // Validate confirm password
  if(empty(trim($_POST["CONFIRM_PASSWORD"]))){
    $CONFIRM_PASSWORD_ERR = "Please confirm password.";
    echo "<script>alert('Please confirm password !'); location.href='AccountantSignUp.html';</script>";

  } else{
    $CONFIRM_PASSWORD = trim($_POST["CONFIRM_PASSWORD"]);
    if(empty($ACC_PASSWORD_ERR) && ($ACC_PASSWORD != $CONFIRM_PASSWORD)){
      $CONFIRM_PASSWORD_ERR = "Password did not match.";
      echo "<script>alert('Password did not match. !'); location.href='AccountantSignUp.html';</script>";

    }
  }

  // Check input errors before inserting in database
  if(empty($ACC_EMAIL_ERR) && empty($ACC_PASSWORD_ERR) && empty($CONFIRM_PASSWORD_ERR)){

    // Prepare an insert statement
    $sql = "INSERT INTO ACCOUNTANT_DETAILS (ACC_EMAIL, ACC_PASSWORD) VALUES (?, ?)";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("ss", $param_username, $param_password);

      // Set parameters
      $param_username = $ACC_EMAIL;
      // $param_password = $ACC_PASSWORD;
      $param_password = password_hash($ACC_PASSWORD, PASSWORD_DEFAULT); // Creates a password hash

      // Attempt to execute the prepared statement
      if($stmt->execute()){
        // Redirect to login page
        session_start();

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["ACC_ID"] = $ACC_ID;
        $_SESSION["ACC_EMAIL"] = $ACC_EMAIL;
        echo "<script>alert('Sign Up successful !'); location.href='AccountantLogin.php';</script>";

        // header("location: AddEmployee.html");
      } else{
        echo "Something went wrong. Please try again later.";
        echo "<script>alert('Something went wrong. Please try again later.'); location.href='AccountantSignUp.html';</script>";

      }

      // Close statement
      $stmt->close();
    }
  }

  // Close connection
  $mysqli->close();
}
?>
