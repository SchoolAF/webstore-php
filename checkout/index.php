<?php

// Configure your mysql database connection details:

$mysqlserverhost = "localhost";
$database_name = "store";
$username_mysql = "root";
$password_mysql = "";

// ------------------------- Do not modify code under this field -------------------------- //


function sanitize($variable){
	$clean_variable = strip_tags($variable);
	$clean_variable = htmlentities($clean_variable, ENT_QUOTES, 'UTF-8');
	return $clean_variable;
}

function connect_to_mysqli($mysqlserverhost, $username_mysql, $password_mysql, $database_name){
	$connect = mysqli_connect($mysqlserverhost, $username_mysql, $password_mysql, $database_name);
	if (!$connect) {
		  die("Connection failed mysql: " . mysqli_connect_error());
	}
	return $connect;	
}

if(isset($_POST["processform"])){
	$connection = connect_to_mysqli($mysqlserverhost, $username_mysql, $password_mysql, $database_name);
	$firstfield = mysqli_real_escape_string($connection, sanitize($_POST["firstfield"]));
	$secondfield = mysqli_real_escape_string($connection, sanitize($_POST["secondfield"]));
	$thirdfield = mysqli_real_escape_string($connection, sanitize($_POST["thirdfield"]));
	$fourthfield = mysqli_real_escape_string($connection, sanitize($_POST["fourthfield"]));	 
	$sql = "INSERT INTO table_form (dbfield1, dbfield2, dbfield3, dbfield4) VALUES ('$firstfield', '$secondfield', '$thirdfield', '$fourthfield')";
	if (mysqli_query($connection, $sql)) {
		  header("Location: ../succeed.html");
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
	}
	mysqli_close($connection);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout - Halcyon</title>
<link rel="stylesheet" href="../css/main.css" />
<!-- Icon Lib -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript">
  function validateForm() {
    var a = document.forms["Form"]["firstfield"].value;
    var b = document.forms["Form"]["secondfield"].value;
    var c = document.forms["Form"]["thirdfield"].value;
    var d = document.forms["Form"]["fourthfield"].value;
    if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "") {
      alert("Please Fill All Required Field");
      return false;
    }
  }
</script>
</head>
<body>
  <div class="container">
    <div class="topnav">
      <a href="../index.html"><span>Back</span></a>
    </div>
    <br>
    <h3>Checkout</h3>
    <br>
  </div>

  <div class="container">
  <div class="row">
    <div class="column-co" id="Form">
      <form action="index.php" method="post" name="Form" onsubmit="return validateForm()">
        <input type="hidden" name="processform" value="1">
        <div id="cust_name">
          <label for="field1">Name</label>
          <br>
          <input id="field1" type="text" name="firstfield" class="form-tb">
        </div>
        <br>
        <div id="cust_addr">
          <label for="field2">Address</label>
          <br>
          <input id="field2" type="text" name="secondfield" class="form-tb">
        </div>
        <br>
        <div id="cust_name">
          <label for="field3">Phone Number</label>
          <br>
          <input id="field3" type="text" name="thirdfield" class="form-tb">
        </div>
        <br>
        <div id="cust_name">
          <label for="field4">Product</label>
          <br>
          <select id="field4" name="fourthfield" class="form-tb">
            <option style="background-color: black;" value="null">Select Product</option>
            <option style="background-color: black;" value="LAF15">ASUS TUF GAMING F15</option>
            <option style="background-color: black;" value="RPTU">Razer Pro Typle Ultra</option>
            <option style="background-color: black;" value="ASRT">ASUS ROG Throne</option>
            <option style="background-color: black;" value="ASRC">ASUS ROG Centurion</option>
            <option style="background-color: black;" value="NXT1">HLCYN NXT 1 Ultra</option>
          </select>
        </div>
        <br>
        <input class="btn_main" type="submit" value="Checkout!">
      </form>  
    </div>

  </div>
  </div>

  <div class="container">
    <br>
    <br>
    <div class="mesg" id="mesg">
      <p>Domestic shipping will takes time arround 3-5 Work days. Depending on your location.</p>
      <p>International shipping will takes time more than 7 Work days. Depending on your location.</p>
    </div>
  </div> 
  <div class="container footer">
  <span>Halcyon Store
  <br>
  Copyright © 2022 NXTZ Network</span>
  </div>

</body>
</html>