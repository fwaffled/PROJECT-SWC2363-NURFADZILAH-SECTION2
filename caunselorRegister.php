<head>
  <title>mentalhealth System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
}

* {
  box-sizing: border-box;
}
body {  
    margin: 50px auto;  
    text-align: center;  
    width: 800px;  
}  
form {  
    margin: 25px auto;  
    padding: 20px;  
    border: 5px solid #ccc;  
    width: 400px;  
    background: #f3e7e9;  
}
/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 20%;
}
button:hover {
  opacity: 0.8;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.8;
}
.registerbtn:hover {
  opacity: 1;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>
	<?php
	//call file to connect server eleave
	include ("headerProject.php");
    ?>

    <?php
    //This query inserts a record in the mentalhealth table
    //has form been submited?
    if ($_SERVER['REQUEST_METHOD']=='POST')
    {
    	$error = array ();//initialize an error array

    	//check for a caunselorPassword
    	if (empty ($_POST ['caunselorPassword']))
    	{
    		$error [] = 'You forgot to the password.';
    	}
    else
    {
    	$p = mysqli_real_escape_string ($connect,trim ($_POST ['caunselorPassword']));
    }
    // check for a caunselorName
    if (empty ($_POST ['caunselorName']))
    {
    	$error [] = 'Your forgot to enter your name.';
    }
    else
    {
    	$n = mysqli_real_escape_string ($connect, trim ($_POST ['caunselorName']));
    }

    //Check for a caunselorPhoneNo
    if (empty ($_POST ['caunselorPhoneNo']))
    {
    	$error [] = 'You forgot to enter your phone number.';
    }
    else
    {
    	$ph =mysqli_real_escape_string ($connect , trim ($_POST ['caunselorPhoneNo']));
    }

    //Check for a caunselorEmail
    if (empty ($_POST ['caunselorEmail']))
    {
    	$error [] = 'You forgot to enter your email.';
    }
    else
    {
        $e =mysqli_real_escape_string ($connect , trim ($_POST ['caunselorEmail']));
    }

    //register the caunselor in the database
    //make the query:
    $q ="INSERT INTO caunselor (caunselorID, caunselorPassword, caunselorName, caunselorPhoneNo, caunselorEmail)
    VALUES ('','$p','$n','$ph','$e')";
    $result = @mysqli_query ($connect, $q);//run the query
    if ($result)//if it runs
    {
    	echo '<h1>thank you</h1>';
    	echo '<h4>Log in again:</h4>';
      echo '<a href="caunselorLogin.php"><button>Click Here</button></a>';
      exit();
    }
    else
    {
    	//if it didn't run
    	//message
    	echo'<h1>System error<h1>';

    	//debugging message
    	echo '<p>'.mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
    }//end of it (result)
        mysqli_close($connect); //close the database connection_aborted
        exit();
    }//end of the main submit conditional
?>

<h2> REGISTER CAUNSELOR </h2>
<form action="caunselorRegister.php" method="post">

	<div class="container">
		<label for="caunselorPassword"><b>Password:</b></label>
		<input type="password" id="caunselorPassword" name="caunselorPassword" size ="15" maxlength="60"
		pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter,and at least 8 or more character" required
        value="<?php if (isset($_POST['caunselorPassword'])) echo $_POST ['caunselorPassword'];?>">
    
	<label for="caunselorName">Caunselor Name: </label>
	<input type="text" id="caunselorName" name="caunselorName" size="30" maxlength="50" required
	value="<?php if (isset($_POST['caunselorName'])) echo $_POST ['caunselorName'];?>">

	<label for="caunselorPhoneNo">Phone Number:</label>
	<input type="text" pattern ="[0-9]{3}-[0-9]{7}" id="caunselorPhoneNo" name="caunselorPhoneNo" size ="15" maxlength="20" required
	value="<?php if (isset($_POST['caunselorPhoneNo'])) echo $_POST ['caunselorPhoneNo'];?>">

    <label for ="caunselorEmail">Caunselor Email:</label>
    <input type ="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
    id="caunselorEmail" name="caunselorEmail" size ="30" maxlength="50" required
    value="<?php if (isset($_POST['caunselorEmail'])) echo $_POST ['caunselorEmail'];?>">

    <button type="submit" class="registerbtn">Register</button>
  </div>

    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    </form>
</body>
</html>