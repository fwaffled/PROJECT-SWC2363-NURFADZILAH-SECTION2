<html>
    <head>
        <title>mentalhealth System</title>
    </head>
<body>
    <?php
    //call file to connect server eleave
    include ("headerProject.php");
    ?>
    <form action="patientFound.php" method="post">

    <h1>Search Patient Record</h1>
    <p><label class="label" for="patientName">Patient Name:</label>
    <input id="patientName" type="text" name="patientName"
    size="30" maxlength="50" value="<?php if(isset($_POST['patientName']))
    echo $_POST ['patientName'];?>"/></p>

    <input id="submit" type="submit" name="submit" value="search"/></p>
</form>
</body>
</html>