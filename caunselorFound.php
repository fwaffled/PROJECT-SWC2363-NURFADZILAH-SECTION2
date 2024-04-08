<html>
<head>
<title>mentalhealth System</title>
</style>
</head>

<?php
    //call file to connect server eleave
    include("headerProject.php");
?>
<h2> Search Result </h2>

<?php   
    $in = $_POST['caunselorName'];
    $in = mysqli_real_escape_string($connect, $in);

    //make the query
    $q = "SELECT caunselorID, caunselorPassword, caunselorName,
          caunselorPhoneNo, caunselorEmail FROM caunselor WHERE
          caunselorName='$in' ORDER BY caunselorID";

    //run the query and assign it to the variable $result
    $result = @mysqli_query ($connect, $q);

    if($result)
    {
        //Table heading
        echo '<table border = "2">
        <tr> 
        <td align = "center"><strong>ID</strong></td>
        <td align = "center"><strong>NAME</strong></td> 
        <td align = "center"><strong>PHONE NO.</strong></td>
        <td align = "center"><strong>EMAIL</strong></td>
        </tr>';

    //fetch and print all the records
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        echo '<tr>
        <td>'.$row['caunselorID'].'</td>
        <td>'.$row['caunselorName'].'</td>
        <td>'.$row['caunselorPhoneNo'].'</td>
        <td>'.$row['caunselorEmail'].'</td>
        </tr>';
    }
    
    //close the table
    echo '</table>';
    echo '<h4>Back to selection page</h4>';
    echo '<a href="patientEdit.php"><button>Click Here for Patient</button></a>';
    echo '<a href="caunselorEdit.php"><button>Click Here for Caunselor</button></a>';
    
    //free up the resources
    mysqli_free_result($result);
    //if failed to run
    }
    else
    {
        //error nessage
        echo '<p class = "error"> If no record is shown, this 
        is because you had an incorrect or missing entry in 
        search form.<br>Click the back button on the browser and try again.</p>';

        //debugging message
        echo '<p>'.mysqli_error ($connect).'<br><br/>Query:'.$q.'</p>';
    }//end of it ($result)
    //close the database connection
    mysqli_close($connect);
?>

</div>
</div>
</body>
</html>