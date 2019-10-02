

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="../style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="header">
      <h1>Hr-schema-mysql database</h1>
      <p> <?php
                          if(!isset($_SESSION))
                          {
                              session_start();
                          }
                          if(isset($_SESSION['logiran'])){
                              echo "Dobrodosli ".$_SESSION['user'];
                          }
                          ?></p>
    </div>

    <header>
        <div class="topnav" id="myTopnav">
            <a href="../employee/listEmployees.php" class="active">Employees</a>
            <a href="../employee/createEmployee.php">Unesi zaposlenika</a>
            <a href="../../../jquery_wsdl/jquery/index.html">Putanja na jquery(i wsdl) dio</a>
            <a href="javascript:void(0);" class="icon" onclick="navBarResponzive()">
                <i class="fa fa-bars"></i>
            </a>
            <?php

            if(isset($_SESSION['logiran'])){
                echo "<a href='../LoginSession/logout.php'>Odjava</a>";
            }
            ?>
        </div>
    </header>
