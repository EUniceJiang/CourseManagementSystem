<?php 
    //Start Session
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Required meta tages-->
        <meta charset="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=0">

        <!--CSS stylesheet-->
        <link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Bootstrap ICON-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <title>Course Management System</title>
        
    </head>

    <body>
        
        <!--Navigation Bar, Different navigation content will be displayed, it depends on users' role-->
        <?php 
            //Student Role
            if ($_SESSION['session_Role'] == 'Student'){        
        ?>
            <!--Student Navigation Bar-->
            <div class="menu"><?php include('StudentNav.php');?></div>
        <?php 
            } 

            //UC or DC role
            if ($_SESSION['session_Role'] == 'UC' or $_SESSION['session_Role'] == 'DC' or $_SESSION['session_Role'] == 'Lecturer' or $_SESSION['session_Role'] == 'Tutor'){
        
        ?>
             <!--Staff Navigation Bar-->
            <div class="menu"><?php include('StaffNav.php');?></div>
        
        <?php 
        } 
            //Other role
            if($_SESSION['session_Role'] == ''){
        ?>
            <!--Other Roles' Navigation Bar-->
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                <!--Brand Icon-->
                <a class="navbar-brand" href="#">DoWell</a>

                <!--Collapse Button-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                        
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./Home.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./Unit_Detail.php">Unit Detail</a>
                        </li>
                                        
                    </ul>
                    
                    <!--If user don't login, show the register and log in buttons-->
                    <?php
                        if(!isset($_SESSION['session_user'])){
                    ?>
                    <ul class="nav navbar-nav ml-auto">
                        <br>
                        <li>
                            <button class="btn btn-dark" type="button" id="loginbtn"><i class="fas fa-sign-in-alt"></i> Log in</button>
                        </li>

                        <li>
                            <button class="btn btn-dark" type="button" id="registerbtn"><i class="fa fa-user-plus"></i> Register</button>
                        </li>
                    </ul>

                    <?php

                        }
                    ?>                            
                </div>  
            </nav>

        <?php } ?>

        
        <!--Main Content-->
        <div class="container-fluid bg">
            <br><br><br><br><br><br><br><br>
            <h3 class="Message">Welcome to the University of DoWell</h3>
            <br>
            <h1 class="Message">Course Management System</h1>
            <br><br>
        </div> 
        
        <!-- Footer -->
        <?php include('Footer.php'); ?>
        

        <!--Optional JavaScript-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!--jQuery first, then Poper.js, then Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!--Use external js files-->
        <script type="text/javascript" src="../JS/buttons.js"></script>
        

    </body>
</html>