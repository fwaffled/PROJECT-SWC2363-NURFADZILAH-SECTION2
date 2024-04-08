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
  margin-bottom: 40px;
  margin-right: 80px;
  background-color: lightblue;
}
</style>
    </head>

    <?php
    //call file to connect server eleave
    include("headerProject.php");
    ?>
    <h2>List of Caunselor</h2>

    <?php
    //make the query
    $q = "SELECT caunselorID, caunselorPassword, caunselorName, caunselorPhoneNo, caunselorEmail
    FROM caunselor ORDER BY caunselorID";

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
        <td align="center"><strong>UPDATE</strong></td>
        <td align="center"><strong>DELETE</strong></td>
        </tr>';

        //Fetch and print all the records
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            echo '<tr>
            <td>'.$row['caunselorID'].'</td>
            <td>'.$row['caunselorName'].'</td>
            <td>'.$row['caunselorPhoneNo'].'</td>
            <td>'.$row['caunselorEmail'].'</td>
            <td align="center"><a href="caunselorUpdate.php?id='.$row['caunselorID'].'">Update</a></td>
            <td align="center"><a href="caunselorDelete.php?id='.$row['caunselorID'].'">Delete</a></td>
            </tr>';
        }
        //close the table
        echo '</table>';
        echo '<h4>Back to selection page</h4>';
        echo '<a href="caunselorEdit.php"><button>Click Here</button></a>';
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