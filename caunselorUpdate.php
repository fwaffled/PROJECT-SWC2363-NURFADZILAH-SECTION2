<html>
<head>
    <title>mentalhealth System</title>
</head>
<body>
    <?php
    // Call file to connect server eLeave
    include("headerProject.php");
    ?>
    
    <h2> Edit Caunselor Record </h2>

<?php
// Include file to connect to the server eLeave
include("headerProject.php");

// Check if caunselor ID is provided and is numeric
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
    $id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
    $id = $_POST['id'];
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array(); // Initialize an error array

    // Validate caunselorName
    if (empty($_POST['caunselorName'])) {
        $error[] = 'You forgot to enter your name.';
    } else {
        $caunselorName = mysqli_real_escape_string($connect, trim($_POST['caunselorName']));
    }

    // Validate caunselorPhoneNo
    if (empty($_POST['caunselorPhoneNo'])) {
        $error[] = 'You forgot to enter your phone number.';
    } else {
        $caunselorPhoneNo = mysqli_real_escape_string($connect, trim($_POST['caunselorPhoneNo']));
    }

    // Validate caunselorEmail
    if (empty($_POST['caunselorEmail'])) {
        $error[] = 'You forgot to enter your email.';
    } else {
        $caunselorEmail = mysqli_real_escape_string($connect, trim($_POST['caunselorEmail']));
    }

    // If no errors occurred
    if (empty($error)) {
        $q = "SELECT caunselorID FROM caunselor WHERE caunselorName = '$caunselorName' AND caunselorID != $id";
        $result = mysqli_query($connect, $q);

        if (mysqli_num_rows($result) == 0) {
            $q = "UPDATE caunselor SET caunselorName = '$caunselorName', caunselorPhoneNo = '$caunselorPhoneNo', caunselorEmail = '$caunselorEmail' WHERE caunselorID = '$id' LIMIT 1";
            $result = mysqli_query($connect, $q);

            if (mysqli_affected_rows($connect) == 1) {
                echo '<script>alert("The user has been edited"); window.location.href="caunselorList.php";</script>';
                exit();
            } else {
                echo '<p class="error">The user has not been edited due to a system error. We apologize for any inconvenience.</p>';
                echo '<p>' . mysqli_error($connect) . '<br/> query:' . $q . '</p>';
            }
        } else {
            echo '<p class="error">The ID has already been registered.</p>';
        }
    } else {
        echo '<p class="error">The following error(s) occurred: <br/>';
        foreach ($error as $msg) {
            echo "- $msg <br>\n";
        }
        echo '<p>Please try again.</p>';
    }
}

// Fetch caunselor information
$q = "SELECT caunselorName, caunselorPhoneNo, caunselorEmail FROM caunselor WHERE caunselorID = $id";
$result = mysqli_query($connect, $q);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // Generate the form
    echo '<form action="caunselorUpdate.php" method="post">
            <p><label class="label" for="caunselorName">Caunselor Name*:</label>
            <input type="text" id="caunselorName" name="caunselorName" size="30" maxlength="50" value="' . $row['caunselorName'] . '"></p>
    
            <p><br><label class="label" for="caunselorPhoneNo">Phone No.*:</label>
            <input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="caunselorPhoneNo" name="caunselorPhoneNo" size="15" maxlength="20" value="' . $row['caunselorPhoneNo'] . '"></p>
    
            <p><br><label class="label" for="caunselorEmail">Caunselor Email.*:</label>
            <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="caunselorEmail" name="caunselorEmail" size="30" maxlength="50" required value="' . $row['caunselorEmail'] . '"></p>
    
            <br><p><input id="submit" type="submit" name="submit" value="Update"></p>
            <br><input type="hidden" name="id" value="' . $id . '"/>
          </form>';
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
}

// Close the database connection
mysqli_close($connect);
?>
</body>
</html>