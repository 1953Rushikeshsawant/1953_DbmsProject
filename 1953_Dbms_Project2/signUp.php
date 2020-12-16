<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");


if($mysqli === false){
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}



// Define variables and initialize with empty values
$username = $PASSWORD = $confirm_password = "";
$username_err = $PASSWORD_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Validate username
  if(empty(trim($_POST["EMAIL"]))){
    $username_err = "Please enter a username.";
    echo "<script>alert('Please enter a username!'); location.href='SignUp.html';</script>";


  } else{
    // Prepare a select statement
    $sql = "SELECT EID FROM employee WHERE EMAIL = ?";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_username);

      // Set parameters
      $param_username = trim($_POST["EMAIL"]);

      // Attempt to execute the prepared statement
      if($stmt->execute()){
        /* store result */
        $stmt->store_result();

        if($stmt->num_rows == 1){
          $username_err = "This username is already taken.";
          echo "<script>alert('This username is already taken.!'); location.href='SignUp.html';</script>";

        } else{
          $username = trim($_POST["EMAIL"]);
        }
      } else{
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  // Validate password
  if(empty(trim($_POST["PASSWORD"]))){
    $PASSWORD_err = "Please enter a password.";
    echo "<script>alert('Please enter password !'); location.href='SignUp.html';</script>";

  } elseif(strlen(trim($_POST["PASSWORD"])) < 6){
    $PASSWORD_err = "Password must have atleast 6 characters.";
    echo "<script>alert('Password must have atleast 6 characters.!'); location.href='SignUp.html';</script>";

  } else{
    $PASSWORD = trim($_POST["PASSWORD"]);
  }

  // Validate confirm password
  if(empty(trim($_POST["CONFIRM_PASSWORD"]))){
    $confirm_password_err = "Please confirm password.";
    echo "<script>alert('Please confirm password !'); location.href='SignUp.html';</script>";

  } else{
    $confirm_password = trim($_POST["CONFIRM_PASSWORD"]);
    if(empty($PASSWORD_err) && ($PASSWORD != $confirm_password)){
      $confirm_password_err = "Password did not match.";
      echo "<script>alert('Password did not match. !'); location.href='SignUp.html';</script>";

    }
  }

  // Check input errors before inserting in database
  if(empty($username_err) && empty($PASSWORD_err) && empty($confirm_password_err)){

    // Prepare an insert statement
    $sql = "INSERT INTO employee (EMAIL, PASSWORD) VALUES (?, ?)";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("ss", $param_username, $param_password);

      // Set parameters
      $param_username = $username;
      // $param_password = $PASSWORD;
      $param_password = password_hash($PASSWORD, PASSWORD_DEFAULT); // Creates a password hash

      // Attempt to execute the prepared statement
      if($stmt->execute()){
        // Redirect to login page
        session_start();

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["EID"] = $EID;
        $_SESSION["EMAIL"] = $EMAIL;
        echo "<script>alert('Sign Up successful !'); location.href='login.php';</script>";

        // header("location: AddEmployee.html");
      } else{
        echo "Something went wrong. Please try again later.";
        echo "<script>alert('Something went wrong. Please try again later.'); location.href='SignUp.html';</script>";

      }

      // Close statement
      $stmt->close();
    }
  }

  // Close connection
  $mysqli->close();
}
?>
