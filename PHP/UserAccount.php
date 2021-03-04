<?php
//This page is about student "myaccount" page
    
    //db connection
    include('db_conn.php'); 
    
    //starting session
    session_start();

    if(!isset($_SESSION['session_user'])){
        //output alert "login required" and go to login page
        echo "<script type=\"text/javascript\">window.alert('Login Required!');window.location.href = './Login.php';</script>";
        exit();        
    }else{
        //Store in variables
        $emailaddress = $_SESSION['session_user'];
        $name = $_SESSION['session_name'];
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
        <title>Welcome Back</title>
        
    </head>

    <body>
        <!--Navigation Bar-->
        <div id="menu"> <?php include('StudentNav.php'); ?></div>

        <!--Main Content-->
        <div class="container-fluid bg">
            <br><br>

            <!--Header-->
            <h3 class="Message">Welcome Back</h3>
        
            <br><br>  

            <!--Side Navigation-->
            <div class="row">
                <!--Three tabs in side Navigation-->
                <div class="col-2">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Profile</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#EnrolDetails" role="tab" aria-controls="profile">Enrolled Units</a>
                        <a class="list-group-item list-group-item-action" id="list-timetable-list" data-toggle="list" href="#Timetable" role="tab" aria-controls="timetable">My Timetable</a>
                    </div>
                </div>

                <!-- Side navigation contents-->
                <div class="col-10">
                    <div class="tab-content" id="nav-tabContent">

                        <!--First tab (Profile Tab)-->
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            
                            <!--Button for change password-->
                            <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#changepassword_modal">Change Password</button>
                            <br><br>
                            <!--Student update personal information section-->
                            <div class="table-responsive">
                                <table class="table table-hover table-active" id="useraccount_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Student ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>                         
                                            <th scope="col">Birth</th>
                                            <th scope="col">Edit</th>                            
                                        </tr>
                                    </thead>
                                    
                                    <?php
                                        //Query to retrieve students'details
                                        $query = "SELECT * FROM `Users` WHERE `Email`= '$emailaddress';";
                                        
                                        //Execute query to the `Users` table and retrieve the result 
                                        $result = $mysqli->query($query);
        
                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                    
                                        if($result){ 
                                            echo'
                                                <tbody>
                                                    <tr>         
                                                        <td>'.$row["user_id"].'</td>
                                                        <td>'.$row["user_name"].'</td>
                                                        <td>'.$row["Email"].'</td>
                                                        <td>'.$row["Phone"].'</td>
                                                        <td>'.$row["dob"].'</td>
                                                    </tr>  
                                                </tbody>    
                                                            
                                            ';
                                        }
                                        else{
                                            //handly error
                                            echo "Something Wrong!";
                                        }
                                        
                                    ?>

                                </table>   
                            </div>
                        </div>
                        
                        
                        <!--Below section is about students enrolled units and tutorials, also is the content for Enrolled Unit tab-->
                        <div class="tab-pane fade" id="EnrolDetails" role="tabpanel" aria-labelledby="list-profile-list">
                            
                            <!--Enrolled Units-->
                            <div class="table-responsive">
                                <table class="table table-light table-striped">
                                    <?php
                                        //SQL query to select data from Units table, to get the current users' enrol units
                                        $SelectQuery = "SELECT * FROM `Units` WHERE unit_code IN (SELECT unit_code FROM `Enrol_Units` WHERE `Email`= '$emailaddress');";
                                        
                                        //Execute query to the `Units` table and retrieve the result 
                                        $result = $mysqli->query($SelectQuery);
                                            
                                        if($result){
                                            echo'<thead class="thead-dark">';
                                            echo'<tr class="text-left">';
                                            echo"<th>Activity</th>";
                                            echo"<th>Unit Code</th>";
                                            echo"<th>Unit Name</th>";
                                            echo"<th>Unit Coordinator</th>";
                                            echo"<th></th>";
                                            echo"</tr></thead>";
                                            
                                            //Use loop to output the result in each unit
                                            while ($row = $result->fetch_array(MYSQLI_ASSOC)){   
                                    ?>
                                                <form action="UnitWithdraw_engine.php" method="post">
                                                    <tr>
                                                        <td><input type="hidden" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['Activity'];?></td>
                                                        <td><input type="hidden" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                        <td><input type="hidden" name="unit_name"value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="unit_coordinator"value="<?php echo $row['unit_coordinator'];?>"/><?php echo $row['unit_coordinator'];?></td>
                                                        <td><input type="hidden" name="session_user" value="<?php echo $_SESSION['session_user'];?>"/></td>                                                    
                                                    </tr>  
                                                </form>
                                                    
                                        <?php
                                            }
                                        }else{
                                            //handly error
                                            echo "Something Wrong!";
                                        }
                                        ?>
                                    
                                </table>

                                <br>

                            </div>
                            <!--Enrolled Tutorials-->
                            <div class="table-responsive">                      
                                <div class="table">
                                    <table class="table table-light table-striped">
                                        <thead class="thead-dark">
                                            <tr class="text-left">                                    
                                                <th>Activity</th>                  
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Day</th>
                                                <th>Campus</th>
                                                <th>Location</th>
                                                <th>Tutor</th>
                                                <th>Start_Time</th>
                                                <th>End_Time</th>
                                                <th>Duration</th>
                                                <th>Weeks</th>
                                                <th></th>      
                                            </tr>

                                        </thead>
                    
                                        <?php
                                            //SQL query to select data from Tutorials table, to get the current users' enrol tutorial class
                                            $query = "SELECT * FROM `Tutorials` WHERE unit_code IN (SELECT unit_code FROM Enrol_Units WHERE `Email` = '$emailaddress');";     
                                            
                                            //Execute query to the `Tutorials` table and retrieve the result 
                                            $result = $mysqli->query($query);

                                            if ($result){
                                                //Use a loop to output a data row for each tutorial
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){                   
                                        ?>  
                                                <form action="TutorialEnrol_engine.php" method="post">
                                                    <tr>
                                                        <td><input type="hidden" name="Activity" value="<?php echo $row['Activity'];?>"/><?php echo $row['Activity'];?></td>
                                                        <td><input type="hidden" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                        <td><input type="hidden" name="unit_name" value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="Day" value="<?php echo $row['Day'];?>"/><?php echo $row['Day'];?></td>
                                                        <td><input type="hidden" name="Campus" value="<?php echo $row['Campus'];?>"/><?php echo $row['Campus'];?></td>
                                                        <td><input type="hidden" name="Location" value="<?php echo $row['Location'];?>"/><?php echo $row['Location'];?></td>
                                                        <td><input type="hidden" name="Tutor" value="<?php echo $row['Tutor'];?>"/><?php echo $row['Tutor'];?></td>
                                                        <td><input type="hidden" name="Start_time" value="<?php echo $row['Start_time'];?>"/><?php echo $row['Start_time'];?></td>
                                                        <td><input type="hidden" name="End_time" value="<?php echo $row['End_time'];?>"/><?php echo $row['End_time'];?></td>
                                                        <td><input type="hidden" name="Duration" value="<?php echo $row['Duration'];?>"/><?php echo $row['Duration'];?></td>
                                                        <td><input type="hidden" name="End_time" value="<?php echo $row['Weeks'];?>"/><?php echo $row['Weeks'];?></td>
                                                        <td><input type="hidden" name="session_user" value="<?php echo $_SESSION['session_user'];?>"/></td>
                                                        <td><input type="hidden" name="activity_id" value="<?php echo $row['activity_id'];?>"/></td>   
                                                                                                    
                                                                    
                                                    </tr>  
                                                </form>

                                            <?php
                                                            
                                                }
                                            }else{
                                                //handly error
                                                echo "Something Wrong!";
                                            }
                                                        
                                                
                                            ?>                              
                                    </table>
                                </div>
                            
                            </div>
                            
                        </div>

                        <!--This section will display students' individual timetable (My Timetable Tab)-->
                        <div class="tab-pane fade" id="Timetable" role="tabpanel" aria-labelledby="list-timetable-list">
                            <div class="table-responsive">
                                <!--Lectures' Timetable-->
                                <table class="table">
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
                            </div>

                            <div class="table-responsive">
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
            </div>
            
            </div>
          

        </div> 

        <!--Change Password Modal Section-->
        <div id="changepassword_modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                    </div>

                    <div class="modal-body">  
                        <form method="post" onsubmit="return validate();" action="ChangePassword_engine.php">
                            <div class="form-group">
                                <label>New Password</label><br>
                                <input type="password" class="form-control" id="NewPassword" name="NewPassword" action="UserAccount_engine.php">
                                <br>
                            </div>
                                <input type="submit" name="submit" value="submit" class="btn btn-danger">    
                        </form>
                                
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div> 
                </div>
            </div>                
        </div>
        
        <br><br><br>
        <!-- Footer -->
        <?php include('Footer.php'); ?>
        
        <!--Optional JavaScript-->

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        
        <!-- TableEidt script-->
        <script src="../JS/jquery.tabledit.js"></script>
        <script src="../JS/jquery.tabledit.min.js"></script>
            
        <!--Use external js files-->
        <script type="text/javascript" src="../JS/UserAccount.js"></script>
        

    </body>
</html>