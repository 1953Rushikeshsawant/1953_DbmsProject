<?php
// session_start();
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

  } elseif(strlen(trim($_POST["PASSWORD"])) < 6){
    $PASSWORD_err = "Password must have atleast 6 characters.";

  } else{
    $PASSWORD = trim($_POST["PASSWORD"]);
  }

  // Validate confirm password
  if(empty(trim($_POST["CONFIRM_PASSWORD"]))){
    $confirm_password_err = "Please confirm password.";

  } else{
    $confirm_password = trim($_POST["CONFIRM_PASSWORD"]);
    if(empty($PASSWORD_err) && ($PASSWORD != $confirm_password)){
      $confirm_password_err = "Password did not match.";

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
        // echo "<script>alert('Sign Up successful !'); location.href='login.php';</script>";

        header("location: login.php");
      } else{
        echo "Something went wrong. Please try again later.";

      }

      // Close statement
      $stmt->close();
    }
  }

  // Close connection
  $mysqli->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

  <style type="text/css">
  body{
    padding-bottom: 5rem;
    padding-top:10rem;
    padding-left: 50rem;
    font-family: monospace;
    font-size: 2rem;
    font-weight: bold;
    color: white;
    background-image: url("https://images.pexels.com/photos/1173987/pexels-photo-1173987.jpeg?cs=srgb&dl=pexels-jesse-yelin-1173987.jpg&fm=jpg");

    padding-top:10rem;
    padding-left: 50rem;
    text-align:center;
  }
  h1 {
    padding-bottom: 2rem;
  }

  h2 {
    padding-bottom: 2rem;
    text-decoration: underline;
  }
  p{
    color:black;
  }
  .wrapper{ width: 350px; padding: 20px; }
  </style>
</head>
<body>
  <div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label for="">Email Id</label>
        <input type="text" name="EMAIL" class="form-control" placeholder="Email" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($PASSWORD_err)) ? 'has-error' : ''; ?>">
        <label for="">Password</label>
        <input type="password" name="PASSWORD" class="form-control" placeholder="Password" value="<?php echo $PASSWORD; ?>">
        <span class="help-block"><?php echo $PASSWORD_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        <label for="">Confirm Password</label>
        <input type="password" name="CONFIRM_PASSWORD" class="form-control" placeholder="Confirm Password"value="<?php echo $confirm_password; ?>">
        <span class="help-block"><?php echo $confirm_password_err; ?></span>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
      </div>
      <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
  </div>
</body>
</html>
