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
        include ("headerProject.php")
        ?>

        <?php
        //Thid query inserts a record in the eLeave table
        //has form been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $error = array ();//initialize an error array

            //check for a patientPassword
            if (empty ($_POST ['patientPassword']))
            {
                $error [] = 'You forgot to the password.';
            }
            else
            {
                $p = mysqli_real_escape_string ($connect, trim ($_POST['patientPassword']));
            }

            //check for a patientName
            if (empty($_POST['patientName']))
            {
                $error [] = 'You forgot to enter your name.';
            }
            else
            {
                $n = mysqli_real_escape_string ($connect, trim ($_POST['patientName']));
            }

            //check for a patientPhoneNo
            if (empty($_POST['patientPhoneNo']))
            {
                $error [] = 'You forgot to enter your phone number.';
            }
            else
            {
                $ph = mysqli_real_escape_string ($connect, trim ($_POST['patientPhoneNo']));
            }

            //check for a patientEmail
            if (empty($_POST['patientEmail']))
            {
                $error [] = 'You forgot to enter your email.';
            }
            else
            {
                $e = mysqli_real_escape_string ($connect, trim ($_POST['patientEmail']));
            }

            //check for a patientAddress
            if (empty($_POST['patientAddress']))
            {
                $error [] = 'You forgot to enter your address.';
            }
            else
            {
                $ad = mysqli_real_escape_string ($connect, trim ($_POST['patientAddress']));
            }

            //check for a medicalHistory
            if (empty($_POST['medicalHistory']))
            {
                $error [] = 'You forgot to enter your medical history.';
            }
            else
            {
                $mh = mysqli_real_escape_string ($connect, trim ($_POST['medicalHistory']));
            }

            //register the admin in the database
            //make the query:
            $q = "INSERT INTO patient(patientID, patientPassword, patientName, patientPhoneNo,
                 patientEmail, patientAddress, medicalHistory)
                 VALUES ('', '$p', '$n', '$ph', '$e', '$ad', '$mh')";
            $result = @mysqli_query ($connect, $q); //run the query

            if ($result)//if it runs
            {
                echo '<h2>Thank You</h2>';
                echo '<h4>Go to the Patient List</h4>';
                echo '<a href="patientList.php"><button>PATIENT LIST</button></a>';
                exit();
            }
            else
            {
                //if it didnt run
                echo '<hl>System error</hl>';

                //debugging message
                echo '<p>' .mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
            }//end of it (result)

            mysqli_close($connect);
            //close the database connection_aborted
            exit();
        }//end of the main submit conditional
        ?>

        <h2>REGISTER PATIENT</h2>
        <form action = "patientRegister.php" method = "post">
        
        <div>
            <label for ="patientPassword">Password:</label>
            <input type ="password" id ="patientPassword" name="patientPassword" size ="15" maxlength ="60"
            pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title ="Must contain at least one number and
            one uppercase adn lowercase letter, and at least 8 or more characters" required
            value ="<?php if (isset($_POST['patientPassword'])) echo $_POST['patientPassword'];?>">
        </div>
        
        <div>
            <label for = "patientName">Full Name:</label>
            <input type="text" id="patientName" name="patientName" size="30" maxlength="50" required
            value="<?php if(isset($_POST['patientName'])) echo $_POST ['patientName'];?>">
        </div>

        <div>
        <label for = "patientPhoneNo">Phone Number:</label>
            <input type="text" pattern="[0-9]{3}-[0-9]{7}" id="patientPhoneNo" name="patientPhoneNo"
            size="15" maxlength="20" required
            value="<?php if(isset($_POST['patientPhoneNo'])) echo $_POST ['patientPhoneNo'];?>">
        </div>

        <div>
            <label for = "patientEmail">Patient Email*:</label>
            <input type="text" pattern="[a-z0-9._%+-]+[a-z0-9.-]+\.[a-z]{2,}$" 
            id="patientEmail" name="patientEmail" size="30" maxlength="50" required
            value="<?php if(isset($_POST['patientEmail'])) echo $_POST ['patientEmail'];?>">
        </div>

        <div>
            <label for = "patientAddress">Address:</label>
            <input type="text" id="patientAddress" name="patientAddress" size="30" maxlength="50" required
            value="<?php if(isset($_POST['patientAddress'])) echo $_POST ['patientAddress'];?>">
        </div>

        <div>
            <label for = "medicalHistory">Medical History:</label>
            <input type="text" id="medicalHistory" name="medicalHistory" size="30" maxlength="50" required
            value="<?php if(isset($_POST['medicalHistory'])) echo $_POST ['medicalHistory'];?>">
        </div>

        <div>
            <button type="submit">Register</button>
            <button type="reset">Clear All</button>
        </div>
    </body>
    </html>