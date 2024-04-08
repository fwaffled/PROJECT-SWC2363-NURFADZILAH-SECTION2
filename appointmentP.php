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
// Include the file to connect to the database
include("headerProject.php");

// Initialize the $error array
$errors = array();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for appointmentDate
    if (empty($_POST['appointmentDate'])) {
        $errors[] = 'You forgot to enter the date.';
    } else {
        $appointmentDate = mysqli_real_escape_string($connect, $_POST['appointmentDate']);
    }

    // Check for appointmentDuration
    if (empty($_POST['appointmentDuration'])) {
        $errors[] = 'You forgot to enter the appointment duration.';
    } else {
        $appointmentDuration = mysqli_real_escape_string($connect, $_POST['appointmentDuration']);
    }

    // Check for appointmentSession
    if (empty($_POST['appointmentSession'])) {
        $errors[] = 'You forgot to enter the appointment session.';
    } else {
        $appointmentSession = mysqli_real_escape_string($connect, $_POST['appointmentSession']);
    }

    // If there are no errors, insert the appointment into the database
    if (empty($errors)) {
        // Query to insert the appointment into the database
        $query = "INSERT INTO appointment (appointmentDate, appointmentDuration, appointmentSession)
                  VALUES ('$appointmentDate', '$appointmentDuration', '$appointmentSession')";
        
        // Run the query
        $result = mysqli_query($connect, $query);

        if ($result) {
            echo '<h1>Thank you for registering your appointment.</h1>';
            echo '<a href="appointmentList.php"><button>VIEW THE APPOINTMENT</button></a>';

            exit();
        } else {
            // If the query fails, display an error message
            echo '<h1>System error</h1>';
            echo '<p>' . mysqli_error($connect) . '</p>';
        }
    } else {
        // If there are errors, display them
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }

    // Close the database connection
    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>mentalhealth System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* Your CSS styles here */
  </style>
</head>
<body>
  <h2> REGISTER APPOINTMENT </h2>
  <form action="appointmentP.php" method="post">
    <div class="container">
      <label for="appointmentDate">Appointment Date:</label>
      <input type="date" id="appointmentDate" name="appointmentDate" required><br>
      
      <label for="appointmentDuration">Appointment Duration:</label>
      <input type="text" id="appointmentDuration" name="appointmentDuration" size="15" maxlength="20" required><br>
      
      <label for="appointmentSession">Appointment Session:</label>
      <select name="appointmentSession" id="appointmentSession" required>
        <option value="private">Private</option>
        <option value="community">Community</option>
      </select><br>

      <button type="submit" class="registerbtn">Register Appointment</button>
    </div>
  </form>
</body>
</html>
