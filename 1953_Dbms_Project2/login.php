<?php


 session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: AddEmployee.html");
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "salarymanagementsytem2");

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}


// Define variables and initialize with empty values
$EID=$EMAIL =$PASSWORD= "";
$EMAIL_ERR = $PASSWORD_ERR = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["EMAIL"]))){
        $EMAIL_ERR = "Please enter EMAIL.";
        echo "<script>alert('Please enter EMAIL.')</script>";

    } else{
        $EMAIL = trim($_POST["EMAIL"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["PASSWORD"]))){
        $PASSWORD_ERR = "Please enter your password.";
        echo "<script>alert('Please enter your password')</script>";

    } else{
       $PASSWORD= trim($_POST["PASSWORD"]);
    }

    // Validate credentials
    if(empty($EMAIL_ERR) && empty($PASSWORD_ERR)){
        // Prepare a select statement
        $sql = "SELECT EID, EMAIL,PASSWORD FROM employee WHERE EMAIL = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_EMAIL);

            // Set parameters
            $param_EMAIL = $EMAIL;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){
                    // Bind result variables
                    $stmt->bind_result($EID, $EMAIL, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($PASSWORD,$hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["EID"] = $EID;
                            $_SESSION["EMAIL"] = $EMAIL;
                            // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

                            // Redirect user to welcome page
                            // header("location: AddEmployee.html");

                            echo "<script>alert('Login successful !'); location.href='AddEmployee.html';</script>";

                        } else{
                            // Display an error message if password is not valid
                            $PASSWORD_ERR = "The password you entered was not valid.";
                            echo "<script>alert('The password you entered was not valid.')</script>";

                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $EMAIL_ERR = "No account found with that username.";
                    echo "<script>alert('No account found with that username.')</script>";

                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";

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
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
  body{ font: 14px sans-serif;

      padding-top:10rem;
      padding-left: 50rem;
      text-align:center;
      background-color:#dbf6e9;
    }
  .wrapper{ width: 350px; padding: 20px; }
  </style>
</head>
<body>
  <div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo (!empty($EMAIL_ERR)) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input type="text" name="EMAIL" class="form-control" value="<?php echo $EMAIL; ?>">
        <span class="help-block"><?php echo $EMAIL_ERR; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($PASSWORD_ERR)) ? 'has-error' : ''; ?>">
        <label>Password</label>
        <input type="password" name="PASSWORD" class="form-control">
        <span class="help-block"><?php echo $PASSWORD_ERR; ?></span>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Login">
        <a href="index.html">Cancel</a>
      </div>
      <p>Don't have an account? <a href="SignUp.html">Sign up now</a>.</p>
    </form>
  </div>
</body>
</html>
