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
        //Only DC and UC can access this page
        if($_SESSION['session_Role'] == 'DC' or $_SESSION['session_Role'] == 'UC'){
            
        }else{
            //Access deny message and go back to home page
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

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
       
        <!--Bootstrap ICON-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!--Title-->
        <title>Unit Management</title>
        
    </head>

    <body>   
        <!--Navigation Bar-->
        <div id="menu"> <?php include('StaffNav.php'); ?></div>
        <br>

        <!--Main Content-->
        <div class ="container">
            <!--Header-->
            <div class="row" id="Welcometitle">
                <h2 align="center">Allocate Teaching Staff</h2>
            </div>
            <br>

            <!--Reminder Message Section-->
            <div class="row">
                <h6>Reminder: Remember click 'upate' button after typing! Only light input blocks and select box can edit. Please scroll mouse from left to right to go through whole table!</h6>
            </div>

            <br>
       
            <!--Side Navigation-->
            <div class="row">
                <!--Three tabs in side Navigation-->
                <div class="col-2">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Lectures Allocate</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#EnrolDetails" role="tab" aria-controls="profile">Tutorials Allocate</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Consultation Time</a>
                    </div>
                </div>

                <div class="col-10">
                    <!-- Side navigation contents-->
                    <div class="tab-content" id="nav-tabContent">

                        <!--Lectures Edit Section, includes lecturers allocate and other information edit-->
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            
                            <!--All lectures' information-->
                            <div class="table-responsive">
                                <table class="table table-hover table-active" id="lecture_table">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th scope="col">Unit Code</th>
                                            <th scope="col">Unit Name</th>
                                            <th scope="col">Activity</th>
                                            <th scope="col">Lecturer</th>
                                            <th scope="col">Start Time</th>
                                            <th scope="col">End Time</th>                         
                                            <th scope="col">Day</th>
                                            <th scope="col">Location</th>                                
                                        </tr>
                                    </thead>
                                    
                                    <?php
                                        //Query to retrieve Lectures' details
                                        $query = "SELECT * FROM `Lectures`;";

                                        //Execute query to the Lectures table and retrieve the result 
                                        $result = $mysqli->query($query);

                                        if($result){ 
                                            //Use loop to output result
                                            while ($row = $result->fetch_array(MYSQLI_ASSOC)){                                                
                                            ?>   
                                                <form action="TeachingStaffAllocate_engine.php" method="post">
                                                    <tr>
                                                        <td><input type="submit" class="btn btn-info btn-sm" name="upade" id="updatebtn" value="Update"/></td>
                                                        <td><input type="hidden" id="unit_code" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                        <td><input type="hidden" name="unit_name" value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="Activity" value="<?php echo $row['Activity'];?>"/><?php echo $row['Activity'];?></td>
                                                        
                                                        <!--Lecturer value from database-->
                                                        <td><select name='lecturer'>
                                                                <!--Orginal lecturer showed as the selected option-->
                                                                <option value='<?php echo $row['lecturer'] ?>' selected><?php echo $row['lecturer'] ?></option>";
                                                                    <?php 
                                                                        //Query to select users who aren't student 
                                                                        $lecture_query = "SELECT * FROM `Users` WHERE Role_Level != 'Student';";

                                                                        //Execute query to the Users table and retrieve the result 
                                                                        $lecture_result = $mysqli->query($lecture_query);

                                                                        //Using loop to output result as select box option values
                                                                        while($lecture_row = $lecture_result->fetch_array(MYSQLI_ASSOC)){
                                                                            $lecturer = $lecture_row['user_name'];
                                                                            echo"<option value='$lecturer'>$lecturer</option>";                                                                    
                                                                        }
                                                                    
                                                                    ?>
                                                            </select> 
                                                        </td>

                                                        <td><input name="start_time" value="<?php echo $row['start_time'];?>"/></td>
                                                        <td><input name="end_time" value="<?php echo $row['end_time'];?>"/></td>
                                                        
                                                        <td>
                                                            <select name="day">
                                                                <!--Orginal Value showed as the selected option-->
                                                                <option value='<?php echo $row['day'] ?>' selected><?php echo $row['day'] ?></option>
                                                                
                                                                <!--Other days,not from database-->
                                                                <option value='Monday'>Monday</option>
                                                                <option value='Tuesday'>Tuesday</option>
                                                                <option value='Wednesday'>Wednesday</option>
                                                                <option value='Thursday'>Thursday</option>
                                                                <option value='Friday'>Friday</option>
                                                            </select>                                                        
                                                        </td>

                                                        <td><input name="Location" value="<?php echo $row['Location'];?>"/></td>
                                                                                                           
                                                    </tr>  
                                                </form>
                                            <?php
                                            }
                                        }
                                        else{
                                            //handly error
                                            echo "Something Wrong!";
                                        }
                                        
                                    ?>

                                </table>   
                            </div>
                        </div>
                        
                        
                        <!--Below section is about  all tutorials information, also the content for Tutorials Allocate tab-->
                        <div class="tab-pane fade" id="EnrolDetails" role="tabpanel" aria-labelledby="list-profile-list">
                            <!--Button for add new tutorial class-->
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#unitAdd_modal">Add New Tutorial Class</button>
                            <br><br>

                            <!--Tutorial Details-->
                            <div class="table-responsive">
                                <table class="table table-light table-striped">
                                    <?php
                                        //SQL query to get data from Tutorials table
                                        $SelectQuery = "SELECT * FROM `Tutorials`;";

                                        //Execute query to the Tutorials table and retrieve the result 
                                        $result = $mysqli->query($SelectQuery);
                                            
                                        if($result){
                                            echo'<thead class="bg-Secondary">';
                                            echo'<tr class="text-left">';
                                            echo"<th>Action</th>";
                                            echo"<th>Unit Code</th>";
                                            echo"<th>Unit Name</th>";
                                            echo"<th>Activity</th>";
                                            echo"<th>Tutor</th>";
                                            echo"<th>Start Time</th>";
                                            echo"<th>End Time</th>";
                                            echo"<th>Day</th>";
                                            echo"<th>Location</th>";
                                            echo"</tr></thead>";
                                                    
                                            while ($row = $result->fetch_array(MYSQLI_ASSOC)){  
                                            ?>
                                                <form action="TutorAllocate_engine.php" method="post">
                                                    <tr>
                                                        <td>
                                                            <!--Button for users to update or delete records-->
                                                            <button type="submit" class="btn btn-info btn-sm" name="edit" id="editbtn">Update</button>&nbsp;&nbsp;
                                                            <button type="submit" class="btn btn-danger btn-sm" name="remove" id="removebtn" value="Remove">Remove</button>
                                                        </td>
                                                            
                                                        <td><input type="hidden" id="unit_code" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                        <td><input type="hidden" name="unit_name" value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="Activity" value="<?php echo $row['Activity'];?>"/><?php echo $row['Activity'];?></td>
                                                        <td><select name='Tutor'>
                                                                <!--Orginal tutor value showed as the selected option-->
                                                                <option value='<?php echo $row['Tutor'] ?>' selected><?php echo $row['Tutor'] ?></option>";
                                                                    <?php 
                                                                        //SQL query to fetch user information who is tutor or lecturer, they can be allocate to a tutor
                                                                        $Tutor_query = "SELECT * FROM `Users` WHERE `Role_Level` = 'Tutor' OR `Role_Level` = 'lecturer';";

                                                                        //Execute query to the Tutorials table and retrieve the result 
                                                                        $Tutor_result = $mysqli->query($Tutor_query);

                                                                        //Using loop to output result as select box option values
                                                                        while($Tutor_row = $Tutor_result->fetch_array(MYSQLI_ASSOC)){
                                                                            $Tutor = $Tutor_row['user_name'];
                                                                            echo"<option value='$Tutor'>$Tutor</option>";                                                                    
                                                                        }
                                                                        
                                                                    ?>
                                                            </select>  
                                                        </td>
                                                            
                                                        <td><input name="Start_time" value="<?php echo $row['Start_time'];?>"/></td>
                                                        <td><input name="End_time" value="<?php echo $row['End_time'];?>"/></td>
                                                        <td><select name="Day">
                                                                <option value='<?php echo $row['Day'] ?>' selected><?php echo $row['Day'] ?></option>
                                                                <option value='Monday'>Monday</option>
                                                                <option value='Tuesday'>Tuesday</option>
                                                                <option value='Wednesday'>Wednesday</option>
                                                                <option value='Thursday'>Thursday</option>
                                                                <option value='Friday'>Friday</option>
                                                            </select>                                                        
                                                        </td>
                                                        <td><input name="Location" value="<?php echo $row['Location'];?>"/></td>
                                                                                                           
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

                            <!--Add unit details section-->
                            <div id="unitAdd_modal" class="modal fade" role=dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add a new tutorial class</h5>
                                        </div>

                                        <!--New tutorial class add form-->
                                        <div class="modal-body">
                                            <form method="post" action="TutorAllocate_engine.php" id="addtutorialTable">
                                                        
                                                <!--Unit Code Input-->
                                                <div class="form-group">
                                                    <lable for="unitcode">Unit Code:</lable>
                                                    <input type="text" id="unitcode" name="unitcode" class="form-control" placeholder="eg:UIT101">
                                                </div>
                                                        
                                                <!--Unit Name Input-->
                                                <div class="form-group">
                                                    <lable for="unitname">Unit Name:</lable>
                                                    <input type="text" id="unitname" name="unitname" class="form-control" placeholder="eg:Introduction to I.T.">    
                                                </div>

                                                <!--Activity Name Input-->
                                                <div class="form-group">
                                                    <lable for="Activity">Activity:</lable>
                                                    <input type="text" id="Activity" name="Activity" class="form-control" placeholder="eg:UIT101PracA-01,shoud be unique!">
                                                </div>

                                                <!--Tutor Selection Box -->
                                                <div class="form-group">
                                                    <lable for="Tutor">Tutor:</lable>
                                                    <select name='Tutor' id="Tutor">
                                                        <option value='notselect' selected>Not Allocate</option>";
                                                            <?php 
                                                                $Tutor_query = "SELECT * FROM `Users` WHERE Role_Level = 'Tutor' OR  Role_Level = 'lecturer';";
                                                                $Tutor_result = $mysqli->query($Tutor_query);
                                                                while($Tutor_row = $Tutor_result->fetch_array(MYSQLI_ASSOC)){
                                                                    $Tutor = $Tutor_row['user_name'];
                                                                    echo"<option value='$Tutor'>$Tutor</option>";                                                                    
                                                                }
                                                                    
                                                            ?>
                                                    </select>
                                                </div>
                                                        
                                                <!--Capacity Input-->
                                                <div class="form-group">
                                                    <lable for="Capacity">Capacity:</lable>
                                                    <input type="text" id="Capacity" name="Capacity" class="form-control" placeholder="eg:20"> 
                                                </div>
                                                        
                                                <!--Start Time Selection Box-->
                                                <div class="form-group">
                                                    <lable for="Start_time">Start Time:</lable>
                                                    <select name="Start_time" id="Start_time">
                                                        <option value="notselect" selected>Not Allocate</option>
                                                        <option value="9:00">9:00</option>
                                                        <option value="9:30">9:30</option>
                                                        <option value="10:00">10:00</option>
                                                        <option value="10:30">10:30</option>
                                                        <option value="11:00">11:00</option>
                                                        <option value="11:30">11:30</option>
                                                        <option value="12:00">12:00</option>
                                                        <option value="12:30">12:30</option>
                                                        <option value="13:00">13:00</option>
                                                        <option value="13:30">13:30</option>
                                                        <option value="14:00">14:00</option>
                                                        <option value="14:30">14:30</option>
                                                        <option value="15:00">15:00</option>
                                                        <option value="15:30">15:30</option>
                                                        <option value="16:00">16:00</option>
                                                        <option value="16:30">16:30</option>
                                                        <option value="17:00">17:00</option>
                                                        <option value="17:30">17:30</option>
                                                        <option value="18:00">18:00</option>
                                                    </select>
                                                        
                                                    &nbsp;&nbsp;
                                                            
                                                    <!--End Time Selection Box-->
                                                    <lable for="End_time">End Time:</lable>
                                                    <select name="End_time" id="End_time">
                                                        <option value="notselect" selected>Not Allocate</option>
                                                        <option value="9:00">9:00</option>
                                                        <option value="9:30">9:30</option>
                                                        <option value="10:00">10:00</option>
                                                        <option value="10:30">10:30</option>
                                                        <option value="11:00">11:00</option>
                                                        <option value="11:30">11:30</option>
                                                        <option value="12:00">12:00</option>
                                                        <option value="12:30">12:30</option>
                                                        <option value="13:00">13:00</option>
                                                        <option value="13:30">13:30</option>
                                                        <option value="14:00">14:00</option>
                                                        <option value="14:30">14:30</option>
                                                        <option value="15:00">15:00</option>
                                                        <option value="15:30">15:30</option>
                                                        <option value="16:00">16:00</option>
                                                        <option value="16:30">16:30</option>
                                                        <option value="17:00">17:00</option>
                                                        <option value="17:30">17:30</option>
                                                        <option value="18:00">18:00</option>
                                                    </select>
                                                </div>
                                                        
                                                <!--Day Selection Box-->
                                                <div class="form-group">
                                                    <lable for="Day">Day:</lable>
                                                    <select name="Day" id="Day">
                                                        <option value='notselect' selected>No Select</option>
                                                        <option value='Monday'>Monday</option>
                                                        <option value='Tuesday'>Tuesday</option>
                                                        <option value='Wednesday'>Wednesday</option>
                                                        <option value='Thursday'>Thursday</option>
                                                        <option value='Friday'>Friday</option>
                                                    </select>       

                                                    &nbsp;&nbsp;                                                      
                                                            
                                                    <!--Day Selection Box-->
                                                    <lable for="Campus">Campus:</lable>
                                                    <select name="Campus" id="Campus">
                                                        <option value='notselect' selected>No Select</option>
                                                        <option value='Pandora'>Pandora</option>
                                                        <option value='Rivendell'>Rivendell</option>
                                                        <option value='Neverland'>Neverland</option>
                                                    </select>                                                             
                                                </div>
                                                        
                                                <!--Location Input-->
                                                <div class="form-group">
                                                    <lable for="Location">Location:</lable>
                                                    <input type="text" id="Location" name="Location" class="form-control">
                                                </div>
                                                        
                                                <!--Description Input-->
                                                <div class="form-group">
                                                    <lable for="Description">Description:</lable>
                                                    <input type="text" id="Description" name="Description" class="form-control">
                                                </div>
                                                    
                                                <!--Add New Tutorial Class Submit Button-->
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger btn-sm" name="add" id="addbtn" value="add">Add</button>
                                                </div>
                                                        
                                            </form>
                                        </div>
                                                
                                        <!--Button for closing modal-->
                                        <div class="modal-footer"> 
                                            <button type="button" class="btn btn-success" id="close_button" data-dismiss="modal">Close</button>
                                        </div>
                                           
                                    </div>
                                </div>
                            </div>
                                                
                        </div>

                        <!--This section is about Consultation Time edit-->
                        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                            <div class="table-responsive">
                                <table class="table table-hover table-active">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Consultation</th>                      
                                        </tr>
                                    </thead>
                                    
                                        <?php
                                            //SQL query to select all tutor and lecturers information from Users table
                                            $Query = "SELECT * FROM `Users`WHERE `Role_Level`= 'Lecturer' OR `Role_Level` = 'Tutor';";
                                            
                                            //Execute query to the Users table and retrieve the result 
                                            $result = $mysqli->query($Query);
                                                
                                            if($result){
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){  
                                        ?>
                                                    <form action="TutorAllocate_engine.php" method="post">
                                                        <tr>
                                                            <td><button type="submit" class="btn btn-info btn-sm" name="change" id="changebtn">Update</button></td>
                                                            <td><input type="hidden" id="user_name" name="user_name" value="<?php echo $row['user_name'];?>"/><?php echo $row['user_name'];?></td>
                                                            <td><input type="hidden" name="Email" value="<?php echo $row['Email'];?>"/><?php echo $row['Email'];?></td>
                                                            <td><input name="Consultation" value="<?php echo $row['Consultation'];?>"/></td>
                                                        </tr>
                                                    
                                                    </form>
                                                    <?php
                                        
                                                    }
                                            }else{
                                                //Handly error
                                                echo "Something Wrong!";
                                            }
                                            ?>
                                </table>
                            </div>
                        </div>
              
                    </div>
                </div>
            </div>

        </div>

       <br><br><br><br><br>
      
        <!-- Footer -->
        <?php include('Footer.php'); ?>

    

        <!--Optional JavaScript-->
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- TableEidt Plugin script-->
        <script src="../JS/jquery.tabledit.js"></script>
        <script src="../JS/jquery.tabledit.min.js"></script>
        
        <!--Use external js files for doing other function-->
        <script type="text/javascript" src="../JS/addtutorialTable.js"></script>
       
        
    </body>
</html>