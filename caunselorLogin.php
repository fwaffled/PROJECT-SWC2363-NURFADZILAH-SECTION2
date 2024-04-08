<html>
    <head>
        <title>mentalhealth System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
<style>
* {
    padding: 0;  
    margin: 0;
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
    width: 500px;  
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
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
button:hover {
  opacity: 0.8;
}
/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
.container {
  padding: 16px;
}
span.psw {
  float: right;
  padding-top: 16px;
}
</style>
    </head>
    <body>
    <?php
// Call file to connect server eleave
include("headerProject.php");

// This section processes submission from the login form
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate the counselor ID
    if (!empty($_POST['caunselorID'])) {
        $id = mysqli_real_escape_string($connect, $_POST['caunselorID']);
    } else {
        $id = FALSE;
        echo '<p class="error">You forgot to enter your ID.</p>';
    }

    // Validate the counselor password
    if (!empty($_POST['caunselorPassword'])) {
        $p = mysqli_real_escape_string($connect, $_POST['caunselorPassword']);
    } else {
        $p = FALSE;
        echo '<p class="error">You forgot to enter your password.</p>';
    }

    // If no problems
    if ($id && $p) {
        // Retrieve counselor information based on counselor ID
        $q = "SELECT caunselorID, caunselorPassword, caunselorName, caunselorPhoneNo, caunselorEmail FROM caunselor WHERE (caunselorID='$id' AND caunselorPassword='$p')";
        
        // Run the query and assign it to the variable $result
        $result = mysqli_query($connect, $q);

        if (!$result) {
            // Error handling for query execution failure
            echo '<p class="error">Query execution failed: ' . mysqli_error($connect) . '</p>';
        } else {
            // If one database row (record) matches the input
            if (mysqli_num_rows($result) == 1) {
                // Start the session, fetch the record and insert the values in an array
                session_start();
                $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo '<h1>Welcome to Mental Health System</h1>';
                echo '<a href="caunselorEdit.php"><button>EDIT DATA</button></a>';

                exit();
            } else {
                echo '<p class="error">The counselor ID and password entered do not match our records.</p>';
            }
        }
    }
    mysqli_close($connect);
}
?>
        <h2>CAUNSELOR LOGIN</h2>

        <form action ="caunselorLogin.php" method ="post">

        <div class="container">
            <label for ="caunselorID"> Caunselor ID:</label>
            <input ID ="text" placeholder="Enter your ID" id ="caunselorID" name="caunselorID" size ="4" maxlength ="6"
            value ="<?php if (isset($_POST['caunselorID'])) echo $_POST['caunselorID'];?>">
    
            <label for ="caunselorPassword"> Password:</label>
            <input ID ="password" placeholder="password" id ="caunselorPassword" name="caunselorPassword" size ="15" maxlength ="60"
            pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title ="Must contain at least one number and
            one uppercase adn lowercase letter, and at least 8 or more characters" required
            value ="<?php if (isset($_POST['caunselorPassword'])) echo $_POST['caunselorPassword'];?>">

            <div>
                <button ID="submit">Login</button>
               <button ID="reset">Reset</button>

            <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            </div>

            <div>
            <label>Dont have an account?
            <a href ="caunselorRegister.php">Sign Up</a>
            </label>
        </div>
        </form>
    </div>
</body>
</html>