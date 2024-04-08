<html>
    <head>
        <title>mentalhealth System</title>
    </head>
<body>
    <?php
    //call file to connect server eleave
    include("headerProject.php");
    ?>
    <form action="caunselorFound.php" method="post">

    <h1>Search Caunselor Record</h1>
    <p><label class="label" for="caunselorName">Caunselor Name:</label>
    <input id="caunselorName" type="text" name="caunselorName"
    size="30" maxlength="50" value="<?php if(isset($_POST['caunselorName']))
    echo $_POST ['caunselorName'];?>"/></p>

    <input id="submit" type="submit" name="submit" value="search"/></p>
</form>
</body>
</html>