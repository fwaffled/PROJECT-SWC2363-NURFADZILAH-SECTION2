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
  padding: 10px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
table {
  border: 1px solid black;
  margin-top: 50px;
  margin-bottom: 50px;
  margin-right: 80px;
  background-color: lightblue;
}
</style>
    </head>

    <?php
    //call file to connect server eleave
    include("headerProject.php");
    ?>
    <h2>List of Appointment</h2>

    <?php
    //make the query
    $q = "SELECT appointmentID, appointmentDate, appointmentDuration, appointmentSession
    FROM appointment ORDER BY appointmentID";

    //run the query and assign it to the variable $result
    $result = @mysqli_query ($connect, $q);

    if ($result)
    {
        //table heading
        echo '<table border = "2">
        <tr>
        <td align="center"><strong>APPOINTMENT ID</strong></td>
        <td align="center"><strong>APPOINTMENT DATE</strong></td>
        <td align="center"><strong>DURATION</strong></td>
        <td align="center"><strong>SESSION</strong></td>
        <td align="center"><strong>DELETE</strong></td>
        </tr>';

        //Fetch and print all the records
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            echo '<tr>
            <td>'.$row['appointmentID'].'</td>
            <td>'.$row['appointmentDate'].'</td>
            <td>'.$row['appointmentDuration'].'</td>
            <td>'.$row['appointmentSession'].'</td>
            <td align="center"><a href="appointmentDelete.php?id='.$row['appointmentID'].'">Delete</a></td>
            </tr>';
        }
        //close the table
        echo '</table>';
        echo '<h4>Back to selection page</h4>';
        echo '<a href="patientEdit.php"><button>Click Here for the patient</button></a>';
        echo '<a href="caunselorEdit.php"><button>Click Here for the caunselor</button></a>';

        //free up the resources
        mysqli_free_result ($result);
        //if failed to run
    }
    else
    {
        //error message
        echo'<p class="error"> The current user could not be retrieved.
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