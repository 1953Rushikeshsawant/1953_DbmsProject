<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "salarymanagementsystem");

// Check connection
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt select query execution
$sql = "SELECT * FROM employee";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){
    echo "<table>";
    echo "<tr>";
    echo "<th>Eid</th>";
    echo "<th>first_name</th>";
    echo "<th>last_name</th>";
    echo "<th>City</th>";
    echo "<th>State</th>";
    echo "<th>DOB</th>";
    echo "<th>Email</th>";
    echo "<th>password</th>";
    echo "<th>Phone No</th>";
    echo "<th>Bank Acc No</th>";
    echo "<th>gender</th>";
    echo "</tr>";
    while($row = mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>" . $row['EID'] . "</td>";
      echo "<td>" . $row['FNAME'] . "</td>";
      echo "<td>" . $row['LNAME'] . "</td>";
      echo "<td>" . $row['CITY'] . "</td>";
      echo "<td>" . $row['STATE'] . "</td>";
      echo "<td>" . $row['DOB'] . "</td>";
      echo "<td>" . $row['EMAIL'] . "</td>";
      echo "<td>" . $row['PASSWORD'] . "</td>";
      echo "<td>" . $row['PHONE_NO'] . "</td>";
      echo "<td>" . $row['BANK_ACC_NO'] . "</td>";
      echo "<td>" . $row['GENDER'] . "</td>";

      echo "</tr>";
    }
    echo "</table>";
    // Free result set
    mysqli_free_result($result);
  } else{
    echo "No records matching your query were found.";
  }
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
