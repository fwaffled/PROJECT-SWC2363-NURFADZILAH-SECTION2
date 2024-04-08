<html>
<head>
    <title>mentalhealth System</title>
</head>
<body>
    <?php
    // Call file to connect server eLeave
    include("headerProject.php");
    ?>
    
    <h2> Edit Patient Record </h2>

    <?php
    // Look for a valid patient id, either through GET or POST
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = $_GET['id'];
    } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
        $id = $_POST['id'];
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = array(); // Initialize an error array
        
        // Look for a patientName
        if (empty($_POST['patientName'])) {
            $error[] = 'You forgot to enter your name.';
        } else {
            $n = mysqli_real_escape_string($connect, trim($_POST['patientName']));
        }

        // Look for a patientPhoneNo
        if (empty($_POST['patientPhoneNo'])) {
            $error[] = 'You forgot to enter your phone number.';
        } else {
            $ph = mysqli_real_escape_string($connect, trim($_POST['patientPhoneNo']));
        }

        // Look for a patientEmail
        if (empty($_POST['patientEmail'])) {
            $error[] = 'You forgot to enter your email.';
        } else {
            $e = mysqli_real_escape_string($connect, trim($_POST['patientEmail']));
        }

        // Look for a patientAddress
        if (empty($_POST['patientAddress'])) {
            $error[] = 'You forgot to enter your address.';
        } else {
            $ad = mysqli_real_escape_string($connect, trim($_POST['patientAddress']));
        }

        // Look for a medicalHistory
        if (empty($_POST['medicalHistory'])) {
            $error[] = 'You forgot to enter your medical history.';
        } else {
            $mh = mysqli_real_escape_string($connect, trim($_POST['medicalHistory']));
        }

        // If no problem occurred
        if (empty($error)) {
            $q = "SELECT patientID FROM patient WHERE patientName = '$n' AND patientID != $id";

            $result = mysqli_query($connect, $q); // Run the query

            if (mysqli_num_rows($result) == 0) {
                $q = "UPDATE patient SET patientName = '$n', patientPhoneNo = '$ph', patientEmail = '$e', patientAddress = '$ad', medicalHistory = '$mh' WHERE patientID = '$id' LIMIT 2";

                $result = mysqli_query($connect, $q); // Run the query

                if (mysqli_affected_rows($connect) == 1) {
                    echo '<script>alert("The patient has been edited"); window.location.href = "patientList.php";</script>';
                } else {
                    echo '<p class="error">The patient has not been edited due to the system error. We apologize for any inconvenience.</p>';
                    echo '<p>' . mysqli_error($connect) . '<br/> Query: ' . $q . '</p>';
                }
            } else {
                echo '<p class="error">The id has been registered.</p>';
            }
        } else {
            echo '<p class="error">The following error(s) occurred: <br/>';
            foreach ($error as $msg) {
                echo "- $msg<br>\n";
            }
            echo '</p><p>Please try again.</p>';
        }
    }

    $q = "SELECT patientName, patientPhoneNo, patientEmail, patientAddress, medicalHistory FROM patient WHERE patientID = $id";

    $result = mysqli_query($connect, $q); // Run the query

    if (mysqli_num_rows($result) == 1) {
        // Get patient information
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        // Create the form
        echo '<form action="patientUpdate.php" method="post">
            <p><label class="label" for="patientName">Patient Name*:</label>
            <input type="text" id="patientName" name="patientName" size="30" maxlength="50" value="' . $row[0] . '"></p>

            <p><br><label class="label" for="patientPhoneNo">Phone No.*:</label>
            <input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="patientPhoneNo" name="patientPhoneNo" size="15" maxlength="20" value="' . $row[1] . '"></p>

            <p><br><label class="label" for="patientEmail">Patient Email.*:</label>
            <input type="email" id="patientEmail" name="patientEmail" size="30" maxlength="50" required value="' . $row[2] . '"></p>

            <p><br><label class="label" for="patientAddress">Patient Address:</label>
            <input type="text" id="patientAddress" name="patientAddress" size="30" maxlength="50" value="' . $row[3] . '"></p>

            <p><br><label class="label" for="medicalHistory">Medical History</label>
            <input type="text" id="medicalHistory" name="medicalHistory" size="30" maxlength="50" value="' . $row[4] . '"></p>
            
            <br><p><input id="submit" type="submit" name="submit" value="Update"></p>
            <input type="hidden" name="id" value="' . $id . '"/>
        </form>';
    } else {
        // If it didn't run
        // Message
        echo '<p class="error">This page has been accessed in error.</p>';
    }
    mysqli_close($connect); // Close the database connection
    ?>
</body>
</html>