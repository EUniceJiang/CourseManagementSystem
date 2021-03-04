<?php
    //db connection
    include('db_conn.php'); 

    //starting session
    session_start();

    //if the session for username has not been set, initialise it
    if(!isset($_SESSION['session_user'])){
        //Output alert "login required" and go to login page
        echo "<script type=\"text/javascript\">window.alert('Login Required!');window.location.href = './Login.php';</script>";
        exit();        
    }else{
        //store in variables
        $emailaddress = $_SESSION['session_user'];
        $name = $_SESSION['session_name'];

        //Check whethe the user's role is student, this page not allow student to access
        if($_SESSION['session_Role'] == 'Student'){
            //Show access deny alert message to user and go back to Home page
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
        <title>Enrolled Student Details</title>
        
    </head>

    <body>            
        <!--Navigation Bar-->
        <div id="menu"> <?php include('StaffNav.php'); ?></div>
   
        <!--Main Content-->
        <div class="container">
            <br>
            
            <div class="row" id="Welcometitle">
                <h2><p>Enroll Student Details</p></h2>
            </div>
            <br>

            <!--Reminder message section-->
            <div class="row">
                <p>Please click below tab to see different enrolled student list.</p>  
            </div>
           
            <!--Two toggle radio buttons for user to click, to show Unit Enrolled Student List or Tutorial Enrolled Student List-->
            <div class="row">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <!--First button, Unit Enrolled Student List-->
                    <label class="btn btn-primary active">
                        <input type="radio" name="options" id="Unitbtn" autocomplete="off" checked>Unit Enrolled Student List
                    </label>
                    
                    <!--Second button, Tutorial Enrolled Student List-->
                    <label class="btn btn-secondary">
                        <input type="radio" name="options" id="Tutorialbtn" autocomplete="off"> Tutorial Enrolled Student List 
                    </label>
                </div>
            </div>
            <br>

            
            <div class="row">
                <!--Unit Enrolled Student List-->
                <div class="card w-100" id="UnitList">
                    <div class="card-header">
                        <h5>All Unit Enrolled Student List</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-left">
                                        <th scope="col">Unit</th>
                                        <th scope="col">Student</th>
                                        <th scope="col">Campus</th>
                                        <th scope="col">Semester</th>                          
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        //SQL select query to select all units' enrolled students 
                                        $query = "SELECT * FROM `Enrol_Units` ORDER BY `unit_code`;";

                                        $result = $mysqli->query($query);
                                        
                                        if($result){
                                            //Use loop to output result in each unit
                                            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                        ?>
                                            <tr>
                                                <td><?php echo $row['unit_code'];?><?php echo $row['unit_name'];?></td>
                                                <td><?php echo $row['Email'];?></td>
                                                <td><?php echo $row['Campus'];?></td>
                                                <td><?php echo $row['Semester'];?></td>            
                                            </tr>  
                                        <?php

                                            }
                                        }else{
                                            //handly error
                                            echo "Unit Select Wrong!";

                                        }

                                    ?>
                                </tbody>                                
                            </table>
                        </div>
                    </div>
                </div>
                                    
                <!--Tutorials Enrolled Student List-->
                <div class="card w-100" id="TutorialList">
                    <div class="card-header">
                        <h5> All Tutorial Enrolled Students List</h5>
                    </div>

                    <div class="card-body">             
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-left">
                                        <th scope="col">Unit</th>
                                        <th scope="col">Tutotial Class</th>
                                        <th scope="col">Student</th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Tutor</th>
                                        <th scope="col">Campus</th>
                                        <th scope="col">Location</th>                          
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        //SQL select query to select all tutorials' enrolled students 
                                        $query = "SELECT * FROM `Enrol_Tutorials` ORDER BY `unit_code`;";
                                        $result = $mysqli->query($query);
                                        if($result){
                                            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                        ?>
                                            <tr>
                                                <td><?php echo $row['unit_code'];?><?php echo $row['unit_name'];?></td>
                                                <td><?php echo $row['Activity'];?></td>
                                                <td><?php echo $row['Email'];?></td>
                                                <td><?php echo $row['Start_time'];?></td>
                                                <td><?php echo $row['End_time'];?></td>
                                                <td><?php echo $row['Day'];?></td>
                                                <td><?php echo $row['Tutor'];?></td>
                                                <td><?php echo $row['Campus'];?></td>
                                                <td><?php echo $row['Location'];?></td>            
                                            </tr>  
                                        <?php

                                            }
                                        }else{
                                            //handly error
                                            echo "Tutorial Select Wrong!";

                                        }

                                    ?>
                                </tbody>                                
                            </table>
                        </div>
                        
                    </div>
                </div>                       
            </div>
        
          
        </div>
        
        <br><br><br><br>   

        <!-- Footer -->
        <?php include('Footer.php'); ?>
        
        <!--Optional JavaScript-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../JS/Student_Management.js"></script>
        

    </body>
</html>