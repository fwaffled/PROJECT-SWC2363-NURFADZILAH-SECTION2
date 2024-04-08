<html>
<head>
    <title>mentalhealth System</title>
</head>
<body>
    <?php
    // Call file to connect server eleave
    include("headerProject.php");
    ?>
    
    <h2>Search Result</h2>

    <?php   
    // Retrieve search input and sanitize
    $in = isset($_POST['patientName']) ? mysqli_real_escape_string($connect, $_POST['patientName']) : '';

    // Make the query
    $q = "SELECT patientID, patientPassword, patientName, patientPhoneNo, patientEmail, patientAddress, medicalHistory FROM patient WHERE patientName='$in' ORDER BY patientID";

    // Run the query and assign it to the variable $result
    $result = mysqli_query($connect, $q);

    if($result) {
        // Table heading
        echo '<table border="2">
        <tr> 
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>NAME</strong></td> 
        <td align="center"><strong>PHONE NO.</strong></td>
        <td align="center"><strong>EMAIL</strong></td>
        <td align="center"><strong>ADDRESS</strong></td>
        <td align="center"><strong>MEDICAL HISTORY</strong></td>
        </tr>';

        // Fetch and print all the records
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>
            <td>'.$row['patientID'].'</td>
            <td>'.$row['patientName'].'</td>
            <td>'.$row['patientPhoneNo'].'</td>
            <td>'.$row['patientEmail'].'</td>
            <td>'.$row['patientAddress'].'</td>
            <td>'.$row['medicalHistory'].'</td>
            </tr>';
        }
        
        // Close the table
        echo '</table>';
        echo '<h4>Back to selection page</h4>';
        echo '<a href="patientEdit.php"><button>Click Here for Patient</button></a>';
        echo '<a href="caunselorEdit.php"><button>Click Here for Caunselor</button></a>';
        exit();

        // Free up the resources
        mysqli_free_result($result);
    } else {
        // Error message
        echo '<p class="error">If no record is shown, this is because you had an incorrect or missing entry in the search form.<br>Click the back button on the browser and try again.</p>';

        // Debugging message
        echo '<p>'.mysqli_error($connect).'<br><br/>Query:'.$q.'</p>';
    }

    // Close the database connection
    mysqli_close($connect);
    ?>

</body>
</html>