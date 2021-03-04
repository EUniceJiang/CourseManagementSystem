<!DOCTYPE html>
<html lang="en">
    <head>
    <!--Required meta tages-->
        <meta charset="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=0">

        <!--CSS stylesheet-->
        <link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
       
        <!--Bootstrap ICON-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    </head>
    
    <body>
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
                    <li class="nav-item">
                        <a class="nav-link" href="./Unit_Enrollment.php">Unit Enrolment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Tutorial_Allocation.php">Tutorial Allocation</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="./Timetable.php">Timetable</a>
                    </li>                  
                </ul>
                
                <!--To check whether user has login, to show different buttons-->
                <?php
                    if(!isset($_SESSION['session_user'])){
                ?>
                    <!--To display Login and Register buttons if user hasn't login-->
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

                    }else{
                                    
                    ?>

                    <!--To display My Account and Logout buttons if user has login already-->
                    <ul class="nav navbar-nav ml-auto">
                        <li>
                            <button class="btn btn-dark pull-right" type="button" id="myaccountbtn"><i class="far fa-user-circle"></i> My Account</button>
                        </li>

                        <li>
                            <button class="btn btn-dark pull-right" type="button" id="logoutbtn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        </li>
                    </ul>

                <?php
                }
                ?>                            
            </div>  
        </nav>
        

    
        <!--Optional JavaScript-->
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        
        <!--Use external js files for other function-->
        <script type="text/javascript" src="../JS/buttons.js"></script>
        
    </body>
</html>

