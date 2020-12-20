<?php
// Starting session
session_start();

// Destroying session
session_destroy();


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

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
              <h1>Logged Out</h1>
            </div>
              <div class="alert alert-danger fade in">

                <p>You have been Logged out ?</p><br>
                <p>
                  <a href="login.php" class="btn btn-default">Click here to login again</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
