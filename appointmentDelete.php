<html>
    <head>
        <title>mentalhealth System</title>
    </head>

    <?php
    //call file to connect server eleave
    include("headerProject.php");
    ?>
    <h2>Delete appointment Record</h2>

    <?php
    //look for a valid user id, either through GET or POST
    if ((isset($_GET['id'])) && (is_numeric($_GET['id'])))
    {
        $id = $_GET['id'];
    }
    else if ((isset ($_POST['id'])) && (is_numeric($_POST['id'])))
    {
        $id = $_POST['id'];
    }
    else
    {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']== 'POST')
    {
        if ($_POST['sure']=='Yes')//delete the record
        {
            //make the query
            $q = "DELETE FROM appointment WHERE appointmentID = $id LIMIT 1";
            $result = @mysqli_query($connect, $q);//run the query

            if (mysqli_affected_rows($connect) == 1)
            {
                echo '<script>alert("The user has been deleted");
                window.location.href="appointmentList.php";</script>';
            }
            else
            {
                //display error message
                echo '<p class="error"> The record could not be deleted.<br>
                Probably because it does not exist or due to system error.</p>';

                echo '<p>'.mysqli_error($connect).'<br/>Query:'.$q.'</p>';
                //debugging message
            }
        }
        else
        {
            echo'<script>alert("The appointment has NOT been deleted");
            window.location.href="appointmentList.php;</script>';
        }
    }
    else
    {
        //display the form
        //retrieve the member's data
        $q = "SELECT appointmentDate FROM appointment WHERE appointmentID = $id";
        $result = @mysqli_query ($connect, $q);//run the query

        if (mysqli_num_rows($result) == 1)
        {
            //get appointment information
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            echo '<form action="appointmentDelete.php" method="post">
            <input id="submit-no" type="submit" name="sure" value="Yes">
            <input id="submit-no" type="submit" name="sure" value="No">
            <input type="hidden" name="id" value="'.$id.'">
            </form>';
        }
    
        else
        {
            //if it didnt run
            echo '<p class="error">This page has been accessed in error<p>';
            echo '<p>&nbsp;</p>';
        }//end of it (result)
}
mysqli_close($connect);//close the database connection_aborted
?>
</body>
</html>