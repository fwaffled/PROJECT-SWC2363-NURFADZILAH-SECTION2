<html>
    <head>
        <title>mentalhealth System</title>
        <style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
table {
  border: 1px solid black;
  background-color: lightgrey;
}
</style>
    </head>

    <?php
    //call file to connect server eleave
    include("headerProject.php");
    ?>
    <h2>List of Patient</h2>

    <?php
    //make the query
    $q = "SELECT patientID, patientPassword, patientName, patientPhoneNo, patientEmail, 
    patientAddress, medicalHistory FROM patient ORDER BY patientID";

    //run the query and assign it to the variable $result
    $result = @mysqli_query ($connect, $q);

    if ($result)
    {
        //table heading
        echo '<table border = "2">
        <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>NAME</strong></td>
        <td align="center"><strong>PHONE NUM</strong></td>
        <td align="center"><strong>EMAIL</strong></td>
        <td align="center"><strong>ADDRESS</strong></td>
        <td align="center"><strong>MEDICAL HISTORY</strong></td>
        <td align="center"><strong>UPDATE</strong></td>
        <td align="center"><strong>DELETE</strong></td>
        </tr>';

        //Fetch and print all the records
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            echo '<tr>
            <td>'.$row['patientID'].'</td>
            <td>'.$row['patientName'].'</td>
            <td>'.$row['patientPhoneNo'].'</td>
            <td>'.$row['patientEmail'].'</td>
            <td>'.$row['patientAddress'].'</td>
            <td>'.$row['medicalHistory'].'</td>
            <td align="center"><a href="patientUpdate.php?id='.$row['patientID'].'">Update</a></td>
            <td align="center"><a href="patientDelete.php?id='.$row['patientID'].'">Delete</a></td>
            </tr>';
        }
        //close the table
        echo '</table>';
        echo '<a href="patientEdit.php"><button>Click Here for Patient</button></a>';
        echo '<a href="caunselorEdit.php"><button>Click Here for Caunselor</button></a>';
                exit();
        exit();
        //free up the resources
        mysqli_free_result ($result);
        //if failed to run
    }
    else
    {
        //error message
        echo'<p class="error"> The current patient could not be retrieved.
        We apologixe for any inconvenience.</p>';

        //debugging message
        echo '<p>'.mysqli_error ($connect).'<br></br>Query:'.$q.'</p>';
    }//end of if($result)
    //close the database connection
    mysqli_close($connect);
    ?>
    </div>
    </div>
    </body>
    </html>