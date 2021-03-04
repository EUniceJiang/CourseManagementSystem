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
        //store in variables
        $emailaddress = $_SESSION['session_user'];

        //Only students can access this page
        if($_SESSION['session_Role'] != 'Student'){
            //Output access deny message and go back to Home page
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
        
        <!--Titile-->
        <title>Tutoral Allocation</title>
        
    </head>

    <body>            
        <!--Navigation Bar-->
        <div id="menu"> <?php include('StudentNav.php'); ?></div>

        <!--Main Content-->
        <div class="container">
            <br>

            <!--Header-->
            <div class="row" id="Welcometitle">
                <h2><p>Tutorial Allocation System</p></h2>
            </div>

            <br>

            <!--Reminder Message Section-->
            <div class="row">
                <h5>Reminder: You need to enrol an unit firstly, then related tutorial will be displayed!</h5>
            </div>
            
            <br>

            <!--Already Enrolled Tutorial Display Section-->
            <div class="row">
                <div class="card w-100">
                    <div class="card-header">
                        <h4>Enrol Tutorial</h4>
                    </div>              
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table">
                                <table>
                                    <?php
                                        //Using subquery SQL to fetch data 
                                        $SelectQuery = "SELECT * FROM `Tutorials` WHERE `Activity` IN (SELECT `Activity` FROM `Enrol_Tutorials` WHERE `Email` = '$emailaddress');";
                                        
                                        //Execute query to the database and retrieve the result
                                        $result = $mysqli->query($SelectQuery);
                                        
                                            if($result){
                                                echo"<thead>";
                                                echo'<tr class="text-left">';
                                                echo"<th>Action</th>";
                                                echo"<th>Activity</th>";
                                                echo"<th>Unit Code</th>";
                                                echo"<th>Unit Name</th>";
                                                echo"<th>Tutor</th>";
                                                echo"<th>Day</th>";
                                                echo"<th>Campus</th>";
                                                echo"<th>Location</th>";
                                                echo"<th>Start Time</th>";
                                                echo"<th>End Time</th>";
                                                echo"<th>Duration</th>";
                                                echo"<th></th>";
                                                echo"<th></th>";
                                                echo"</tr></thead>";
                                                
                                                //Use loop to output result
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){   
                                    ?>
                                                <form action="TutorialChange_engine.php" method="post">
                                                    <tr>
                                                        <td><input type="submit" name="Withdraw" value="Withdraw" class="btn btn-danger"/></td>
                                                        <td><input type="hidden" name="Activity" value="<?php echo $row['Activity'];?>"/><?php echo $row['Activity'];?></td>
                                                        <td><input type="hidden" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                        <td><input type="hidden" name="unit_name"value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="Tutor"value="<?php echo $row['Tutor'];?>"/><?php echo $row['Tutor'];?></td>
                                                        <td><input type="hidden" name="Day"value="<?php echo $row['Day'];?>"/><?php echo $row['Day'];?></td>
                                                        <td><input type="hidden" name="Campus"value="<?php echo $row['Campus'];?>"/><?php echo $row['Campus'];?></td>
                                                        <td><input type="hidden" name="Location"value="<?php echo $row['Location'];?>"/><?php echo $row['Location'];?></td>
                                                        <td><input type="hidden" name="Start_time"value="<?php echo $row['Start_time'];?>"/><?php echo $row['Start_time'];?></td>
                                                        <td><input type="hidden" name="End_time"value="<?php echo $row['End_time'];?>"/><?php echo $row['End_time'];?></td>
                                                        <td><input type="hidden" name="Duration"value="<?php echo $row['Duration'];?>"/><?php echo $row['Duration'];?></td>
                                                        <td><input type="hidden" name="Enrol_Number"value="<?php echo $row['Enrol_Number'];?>"/></td>
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
                            </div>
                        </div>

                    </div>
                </div>
            </div>   
            
            <br>

            <!--Tutorial Allocation System -->
            <div class="row" id="AllocateTutorial">
                <div class="card w-100">
                    <div class="card-header">
                        <h4>Tutorial Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">                      
                            <div class="table">
                                <table>
                                    <thead>
                                        <tr class="text-left">                                    
                                            <th>Action</th>
                                            <th>Activity</th>
                                            <th>Capacity</th>
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
                                        //Use subquery to fetch related tutorials information, student only can see related tutorials class after they have enrolled a unit
                                        $query = "SELECT * FROM `Tutorials` WHERE unit_code IN (SELECT unit_code FROM Enrol_Units WHERE `Email` = '$emailaddress');";
                                        
                                        //Execute query to the database and retrieve the result
                                        $result = $mysqli->query($query);

                                        if ($result){
                
                                            //Use a loop to output a data row for each unit
                                            while ($row = $result->fetch_array(MYSQLI_ASSOC)){                   
                                            ?>  

                                                <form action="TutorialEnrol_engine.php" method="post">
                                                    <tr>
                                                        <td><input type="submit" name="enrol" value="Enrol" class="btn btn-outline-primary"/></td>
                                                        <td><input type="hidden" name="Activity" value="<?php echo $row['Activity'];?>"/><?php echo $row['Activity'];?></td>
                                                        <td><input type="hidden" name="Capacity" value="<?php echo $row['Capacity'];?>"/><?php echo $row['Enrol_Number']."/" .$row['Capacity'];?></td>
                                                        <td><input type="hidden" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                        <td><input type="hidden" name="unit_name" value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="Day" value="<?php echo $row['Day'];?>"/><?php echo $row['Day'];?></td>
                                                        <td><input type="hidden" name="Campus" value="<?php echo $row['Campus'];?>"/><?php echo $row['Campus'];?></td>
                                                        <td><input type="hidden" name="Location" value="<?php echo $row['Location'];?>"/><?php echo $row['Location'];?></td>
                                                        <td><input type="hidden" name="Tutor" value="<?php echo $row['Tutor'];?>"/><?php echo $row['Tutor'];?></td>
                                                        <td><input type="hidden" name="Start_time" value="<?php echo $row['Start_time'];?>"/><?php echo $row['Start_time'];?></td>
                                                        <td><input type="hidden" name="End_time" value="<?php echo $row['End_time'];?>"/><?php echo $row['End_time'];?></td>
                                                        <td><input type="hidden" name="Duration" value="<?php echo $row['Duration'];?>"/><?php echo $row['Duration'];?></td>
                                                        <td><input type="hidden" name="End_time" value="<?php echo $row['End_time'];?>"/><?php echo $row['Weeks'];?></td>
                                                        <td><input type="hidden" name="session_user" value="<?php echo $_SESSION['session_user'];?>"/></td>
                                                        <td><input type="hidden" name="activity_id" value="<?php echo $row['activity_id'];?>"/></td>   
                                                        <td><input type="hidden" name="Enrol_Number" value="<?php echo $row['Enrol_Number'];?>"/></td>                                                    
                                                            
                                                    </tr>  
                                                </form>

                                            <?php
                                                    
                                            }
                                        }else{
                                            //handly error
                                            echo "Something Wrong!";
                                            }
                                                
                                        //close db connection
                                        $mysqli->close();
                                    ?>                              
                                </table>
                            </div>
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
        
        <!--jQuery,Poper.js,Bootstrap JS Optional JavaScript-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <!--Use external js files for form validate or other functions-->
        <script type="text/javascript" src="../JS/Tutorial_Allocation.js"></script>
        

    </body>
</html>