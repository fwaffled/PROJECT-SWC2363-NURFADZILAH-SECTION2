<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>mentalhealth System</title>
<style>
.btn {
  border: none;
  color: white;
  padding: 30px 40px;
  font-size: 16px;
  cursor: pointer;
}

.epatient {background-color: #04AA6D;} /* Green */
.epatient:hover {background-color: #46a049;}

.ecaunselor {background-color: #2196F3;} /* Blue */
.ecaunselor:hover {background: #0b7dda;}

.appointment {background-color: #ff9800;} /* Orange */
.appointment:hover {background: #e68a00;}

.csearch {background-color: #2196F3;} /* Red */ 
.csearch:hover {background: #0b7dda;}

.psearch {background-color: #04AA6D;} /* Red */ 
.psearch:hover {background-color: #46a049;}

.logout {background-color: #f44336;} /* Red */ 
.logout:hover {background: #da190b;}
</style>
</head>
<body>

<?php
//call file to connect server eleave
include("headerProject.php");
?>

<?php
//This query inserts a record in the mentalhealth table
//has form been submited?
if ($_SERVER['REQUEST_METHOD']=='POST')
{
  $error = array ();//initialize an error array

$result = @mysqli_query ($connect);//run the query
if ($result)//if it runs
{
  echo '<h1>thank you</h1>';
  exit();
}
else
{
  //if it didn't run
  //message
  echo'<h1>System error<h1>';

  //debugging message
  echo '<p>'.mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
}//end of it (result)
    mysqli_close($connect); //close the database connection_aborted
    exit();

}//end of the main submit conditional
?>
<h1>Alert Buttons</h1>

<a href ="patientList.php"><button class="btn epatient">Edit Patient</button></a>
<a href ="caunselorList.php"><button class="btn ecaunselor">Edit Caunselor</button></a>
<a href ="appointmentList.php"><button class="btn appointment">Appointment</button></a>
<a href ="caunselorSearch.php"><button class="btn csearch">Search Caunselor</button></a>
<a href ="patientSearch.php"><button class="btn psearch">Search Patient</button></a>
<a href ="caunselorLogout.php"><button class="btn logout">Log Out</button></a>
</body>
</html>