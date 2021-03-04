<?php
    //db connection
    include('db_conn.php'); 

    //starting session
    session_start();

    //if the session for username has not been set, initialise it
    if(!isset($_SESSION['session_user'])){
        //output alert "login required" and go to login page
        echo "<script type=\"text/javascript\">window.alert('Login Required!');window.location.href = './Login.php';</script>";
        exit();        
    }else{
        //Store in variables
        $emailaddress = $_SESSION['session_user'];
        if($_SESSION['session_Role'] != 'Student'){
            echo "<script type=\"text/javascript\">window.alert('You do not have access to this page!');window.location.href = './Home.php';</script>";
            exit();
        }
    }
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
        
        <!--Page Title-->
        <title>Timetable</title>

    </head>

    <body>            
        <!--Navigation Bar-->
        <div id="menu"> <?php include('StudentNav.php'); ?></div>
        <br><br>

        <!--Header-->
        <div class="container">
            <div class="row" id="Welcometitle">
                <h2>Timetable</h2>
            </div>
        </div>

        <br><br>

        <!--Tow header buttons-->
        <div class="container">
            <div class="row">
                <!--Go to Unit Enrolment page-->
                <a class="btn btn-dark " role="button" href="Unit_Enrollment.php">Go to Unit Enrolment</a>&nbsp;
                
                <!--Go to Tutorial Allocation page-->
                <a class="btn btn-primary " role="button" href="Tutorial_Allocation.php">Go to Tutorial Allocation</a>
            </div>
        </div>

        <br>

        <!--TimeTable-->
        <div class="container">
            <!--Student Weekly Timetable-->
            <div class="row" >
                <!--Using Bootstrap card container-->
                <div class="card w-100 border-info">
                    <div class="card-header border-info bg-info">
                        <h4>My Weekly Timetable</h4>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <!--Lectures' Timetable-->
                            <table class="table table-light">
                                <thead>
                                    <tr class="text-left">
                                        <th scope="col">Activity</th>
                                        <th scope="col">Lecturer</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Start Time</th>                         
                                        <th scope="col">End Time</th>
                                        <th scope="col">Location</th>
                                    </tr>
                                </thead>
                                
                                        <?php
                                            $query = "SELECT * FROM `Lectures` WHERE `unit_code` IN (SELECT `unit_code` FROM `Enrol_Units` WHERE `Email` = '$emailaddress');";
                                            $result = $mysqli->query($query);
                                            
                                            if ($result){
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){                   
                                                    echo '
                                                    <tbody>
                                                        <tr class="text-left">         
                                                            <td>'.$row["Activity"].'</td>
                                                            <td>'.$row["lecturer"].'</td>
                                                            <td>'.$row["day"].'</td>
                                                            <td>'.$row["start_time"].'</td>
                                                            <td>'.$row["end_time"].'</td>
                                                            <td>'.$row["Location"].'</td>                                                
                                                        </tr>  
                                                    </tbody>                      
                                                    ';
                                                }
                                            }
                                            else{
                                                //handly error
                                                echo "Select query wrong!";
                                            }

                                        ?>
                                
                            </table>

                            <!--Tutotials' Timetable-->        
                            <table class="table table-light">
                                <thead>
                                    <tr class="text-left">
                                        <th scope="col">Activity</th>
                                        <th scope="col">Tutor</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Start Time</th>                         
                                        <th scope="col">End Time</th>
                                        <th scope="col">Location</th>
                                    </tr>
                                </thead>
                            
                                        <?php
                                            $query = "SELECT * FROM `Enrol_Tutorials` WHERE `Email` = '$emailaddress';";
                                            $result = $mysqli->query($query);
                                            
                                            if ($result){
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){                   
                                                    echo '
                                                    <tbody>
                                                        <tr class="text-left">         
                                                            <td>'.$row["Activity"].'</td>
                                                            <td>'.$row["Tutor"].'</td>
                                                            <td>'.$row["Day"].'</td>
                                                            <td>'.$row["Start_time"].'</td>
                                                            <td>'.$row["End_time"].'</td>
                                                            <td>'.$row["Location"].'</td>                                                
                                                        </tr>  
                                                    </tbody>                      
                                                    ';
                                                }
                                            }
                                            else{
                                                //handly error
                                                echo "Select query wrong!";
                                            }

                                        ?>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!--Normal Unit Timetable, Not Individual weekly timetable-->
            <div class="row">
                <div class="card w-100">
                    <div class="card-header">
                        <h4>All Unit Timetable</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light">
                                <thead>
                                    <tr class="text-left">
                                        <th scope="col">Activity</th>
                                        <th scope="col">Lecturer</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Start Time</th>                         
                                        <th scope="col">End Time</th>
                                        <th scope="col">Location</th>
                                    </tr>
                                </thead>
                            
                                        <?php
                                            $query = "SELECT * FROM `Lectures` ORDER BY `Activity`;";
                                            $result = $mysqli->query($query);
                                            
                                            if ($result){
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){                   
                                                    echo '
                                                    <tbody>
                                                        <tr class="text-left">         
                                                            <td>'.$row["Activity"].'</td>
                                                            <td>'.$row["lecturer"].'</td>
                                                            <td>'.$row["day"].'</td>
                                                            <td>'.$row["start_time"].'</td>
                                                            <td>'.$row["end_time"].'</td>
                                                            <td>'.$row["Location"].'</td>                                                
                                                        </tr>  
                                                    </tbody>                      
                                                    ';
                                                }
                                            }
                                            else{
                                                //handly error
                                                echo "Select query wrong!";
                                            }
                                        ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <br><br><br><br><br><br>   
      
        <!-- Footer -->
        <?php include('Footer.php'); ?>
        

        <!--Optional JavaScript-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>        
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
       
   
    </body>
</html>