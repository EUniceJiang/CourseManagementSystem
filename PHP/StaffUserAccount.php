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
        <div id="menu"> <?php include('StaffNav.php'); ?></div>
    
        <!--Main Content-->
        <div class="container-fluid bg">   
            <br>

            <!--Header-->
            <div class="Message">
                <h2><p>Welcome Back</p></h2>
            </div>
            <br>

            <!--Different Conents will display to different user roles-->
            <!--If user Role is DC, the will display my account, Unit Enrolled Student List, and Tutorials Enrolled Student List-->
            <?php if ($_SESSION['session_Role'] == 'DC'){
            ?>
                <div class="row">
                    <!--Three tabs in side Navigation-->
                    <div class="col-3">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-myaccount-list" data-toggle="list" href="#myaccount" role="tab" aria-controls="myaccount">My Account</a>
                            <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Unit Enrolled Student</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#EnrolDetails" role="tab" aria-controls="profile">Tutorials Enrolled Student</a>
                        </div>
                    </div>

                    <div class="col-9">
                        <!-- Side navigation contents-->
                        <div class="tab-content" id="nav-tabContent">
                            <!--DC First tab (Profile Tab)-->
                            <div class="tab-pane fade show active" id="myaccount" role="tabpanel" aria-labelledby="list-myaccount-list">
                                <!--Button for change password-->
                                <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#changepassword_modal">Change Password</button><br><br>
                                    
                                <!--DC update personal information section-->
                                <div class="table-responsive">
                                    <table class="table table-hover table-active" id="useraccount_table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Staff ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>                         
                                                <th scope="col">Birth</th>
                                                <th scope="col">Edit</th>                            
                                            </tr>
                                        </thead>
                                            
                                        <?php
                                            //query to retrieve DC's details
                                            $query = "SELECT * FROM `Users` WHERE `Email`= '$emailaddress';";
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
                            
                            <!--DC Second tab-->
                            <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">                                
                                <!--Unit Enrolled Student List-->
                                <div class="table-responsive">
                                    <table class="table table-hover table-active">
                                        <thead>
                                            <tr>                        
                                                <th scope="col">Unit</th>
                                                <th scope="col">Enrolled Students</th>                         
                                                <th scope="col">Campus</th>
                                                <th scope="col">Semester</th>                                
                                            </tr>
                                        </thead>
                                            
                                        <?php
                                            $query = "SELECT * FROM `Enrol_Units` ORDER BY `unit_code` ASC;";
                                            $result = $mysqli->query($query);
                                                                                        
                                            if($result){
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){                                                
                                                ?>   
                                                    <tr>
                                                        <td><?php echo $row['unit_code'];?><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="Email" value="<?php echo $row['Email'];?>"/><?php echo $row['Email'];?></td>
                                                        <td><input type="hidden" name="Campus" value="<?php echo $row['Campus'];?>"/><?php echo $row['Campus'];?></td>
                                                        <td><input type="hidden" name="Semester" value="<?php echo $row['Semester'];?>"/><?php echo $row['Semester'];?></td>                                                    
                                                    </tr>  
                                                        
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
                            
                            <!--DC third tab also the content for Tutorials Enrolled Student tab-->
                            <div class="tab-pane fade" id="EnrolDetails" role="tabpanel" aria-labelledby="list-profile-list">
                                <div class="table-responsive">
                                    <table class="table table-hover table-active">
                                        <?php
                                            $Tutorialquery = "SELECT * FROM `Enrol_Tutorials` ORDER BY `unit_code` ASC;";
                                            $Tutorialresult = $mysqli->query($Tutorialquery);                                                                                   
                                            if($Tutorialresult){
                                                echo'<thead>';
                                                echo'<tr class="text-left">';
                                                echo"<th>Unit </th>";
                                                echo"<th>Activity</th>";
                                                echo"<th>Enrolled Students</th>";
                                                echo"<th>Tutor</th>";
                                                echo"<th>Start Time</th>";
                                                echo"<th>End Time</th>";
                                                echo"<th>Day</th>";
                                                echo"<th>Location</th>";
                                                echo"</tr></thead>";
                                                            
                                               while ($row = $Tutorialresult->fetch_array(MYSQLI_ASSOC)){  
                                        ?>
                                                    <tr>
                                                        <td><?php echo $row['unit_code'];?><?php echo $row['unit_name'];?></td>
                                                        <td><?php echo $row['Activity'];?></td>
                                                        <td><?php echo $row['Email'];?></td>
                                                        <td><?php echo $row['Tutor'];?></td>
                                                        <td><?php echo $row['Start_time'];?></td>
                                                        <td><?php echo $row['End_time'];?></td>
                                                        <td><?php echo $row['Day'];?></td>
                                                        <td><?php echo $row['Location'];?></td>
                                                    </tr>  
                                            <?php
                                                
                                                }
                                            }else{
                                                //handly error
                                                echo "Tutorial enrolled students select Wrong!";
                                            }
                                            ?>
                                        
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <?php
            }
            ?>
                
            <!--If user Role is UC, the will display my account, Unit Enrolled Student List, and Tutorials Enrolled Student List for her/his teaching unit-->
            <?php if ($_SESSION['session_Role'] == 'UC'){
            ?>

                <div class="row">
                    <!--Three tabs in side Navigation-->
                    <div class="col-3">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-myaccount-list" data-toggle="list" href="#myaccount" role="tab" aria-controls="myaccount">My Account</a>
                            <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Unit Enrolled Student</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#EnrolDetails" role="tab" aria-controls="profile">Tutorials Enrolled Student</a>
                        </div>
                    </div>

                    <div class="col-9">
                        <!-- Side navigation contents-->
                        <div class="tab-content" id="nav-tabContent">
                            <!--UC First tab (Profile Tab)-->
                            <div class="tab-pane fade show active" id="myaccount" role="tabpanel" aria-labelledby="list-myaccount-list">
                                <!--Button for change password-->
                                <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#changepassword_modal">Change Password</button><br><br>
                                    
                                <!--UC update personal information section-->
                                <div class="table-responsive">
                                    <table class="table table-hover table-active" id="useraccount_table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Staff ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>                         
                                                <th scope="col">Birth</th>
                                                <th scope="col">Edit</th>                            
                                            </tr>
                                        </thead>
                                            
                                        <?php
                                            $query = "SELECT * FROM `Users` WHERE `Email`= '$emailaddress';";
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

                            <!--UC Second Tab-->                
                            <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">                                
                                <!--UC update personal information section-->
                                <div class="table-responsive">
                                    <table class="table table-hover table-active">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Student ID</th>                         
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>                                
                                            </tr>
                                        </thead>
                                            
                                        <?php
                                            $query = "SELECT * FROM `Users` WHERE `Email` IN (SELECT `Email` FROM `Enrol_Units`WHERE `UC_Email` = '$emailaddress');";
                                            $result = $mysqli->query($query);
                                                                                    
                                            if($result){
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){                                                
                                       ?>   
                                                    <form action="TeachingStaffAllocate_engine.php" method="post">
                                                        <tr>
                                                            <td><input type="hidden" id="user_name" name="user_name" value="<?php echo $row['user_name'];?>"/><?php echo $row['user_name'];?></td>
                                                            <td><input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>"/><?php echo $row['user_id'];?></td>
                                                            <td><input type="hidden" name="Email" value="<?php echo $row['Email'];?>"/><?php echo $row['Email'];?></td>
                                                            <td><input type="hidden" name="Phone" value="<?php echo $row['Phone'];?>"/><?php echo $row['Phone'];?></td>    
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
                            
                            <!--UC Third Tab-->
                            <div class="tab-pane fade" id="EnrolDetails" role="tabpanel" aria-labelledby="list-profile-list">
                                <div class="table-responsive">
                                    <table class="table">
                                        <?php
                                            $Tutorialquery = "SELECT * FROM `Enrol_Tutorials` WHERE `unit_code` IN (SELECT `unit_code` FROM `Enrol_Units` WHERE `UC_Email` = '$emailaddress');";
                                            $Tutorialresult = $mysqli->query($Tutorialquery);                                                                                   
                                            if($Tutorialresult){
                                                echo'<thead>';
                                                echo'<tr class="text-left">';
                                                echo"<th>Enrolled Student</th>";
                                                echo"<th>Unit Code</th>";
                                                echo"<th>Unit Name</th>";
                                                echo"<th>Activity</th>";
                                                echo"<th>Tutor</th>";
                                                echo"<th>Start Time</th>";
                                                echo"<th>End Time</th>";
                                                echo"<th>Day</th>";
                                                echo"<th>Location</th>";
                                                echo"</tr></thead>";
                                                        
                                                while ($row = $Tutorialresult->fetch_array(MYSQLI_ASSOC)){  
                                                ?>
                                                    <form action="TutorAllocate_engine.php" method="post">
                                                        <tr>
                                                            <td><input type="hidden" id="Email" name="Email" value="<?php echo $row['Email'];?>"/><?php echo $row['Email'];?></td>
                                                            <td><input type="hidden" id="unit_code" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                            <td><input type="hidden" name="unit_name" value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                            <td><input type="hidden" name="Activity" value="<?php echo $row['Activity'];?>"/><?php echo $row['Activity'];?></td>
                                                            <td><input type="hidden" name="Tutor" value="<?php echo $row['Tutor'];?>"/><?php echo $row['Tutor'];?></td>
                                                            <td><input type="hidden" name="Start_time" value="<?php echo $row['Start_time'];?>"/><?php echo $row['Start_time'];?></td>
                                                            <td><input type="hidden" name="End_time" value="<?php echo $row['End_time'];?>"/><?php echo $row['End_time'];?></td>
                                                            <td><input type="hidden" name="Day" value="<?php echo $row['Day'];?>"/><?php echo $row['Day'];?></td>
                                                            <td><input type="hidden" name="Location" value="<?php echo $row['Location'];?>"/><?php echo $row['Location'];?></td>                                                           
                                                        </tr>  
                                                    </form>
                                                <?php
                                                
                                                }
                                            }else{
                                                //handly error
                                                echo "Tutorial enrolled students select Wrong!";
                                            }
                                            ?>
                                    </table>

                                    <br>
                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
            
            <br>

            <?php
            }
            ?>

            <!--If user Role is Lecturer, the will display my account, Unit Enrolled Student List, and Tutorials Enrolled Student List for her/his teaching unit-->
            <?php if ($_SESSION['session_Role'] == 'Lecturer'){
            ?>
                <div class="row">
                    <!--Three tabs in side Navigation-->
                    <div class="col-3">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-myaccount-list" data-toggle="list" href="#myaccount" role="tab" aria-controls="myaccount">My Account</a>
                            <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Unit Enrolled Student</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#EnrolDetails" role="tab" aria-controls="profile">Tutorials Enrolled Student</a>
                        </div>
                    </div>

                    <div class="col-9">
                        <!-- Side navigation contents-->
                        <div class="tab-content" id="nav-tabContent">
                            <!--Lecturer First tab-->
                            <div class="tab-pane fade show active" id="myaccount" role="tabpanel" aria-labelledby="list-myaccount-list">
                                <!--Button for change password-->
                                <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#changepassword_modal">Change Password</button><br><br>
                                    
                                <!--Lecturer update personal information section-->
                                <div class="table-responsive">
                                    <table class="table table-hover table-active" id="useraccount_table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Staff ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>                         
                                                <th scope="col">Birth</th>
                                                <th scope="col">Edit</th>                            
                                            </tr>
                                        </thead>
                                            
                                        <?php
                                            $query = "SELECT * FROM `Users` WHERE `Email`= '$emailaddress';";
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
                            
                            <!--Lecturer Second tab-->
                            <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                <div class="table-responsive">
                                    <table class="table table-hover table-active">
                                        <thead>
                                            <tr>
                                                <th scope="col">Unit</th>     
                                                <th scope="col">Student Name</th>                
                                                <th scope="col">Campus</th>
                                                <th scope="col">Semester</th>                                
                                            </tr>
                                        </thead>
                                            
                                        <?php
                                            $query = "SELECT * FROM `Enrol_Units` WHERE `unit_code` IN (SELECT `unit_code` FROM `Lectures` WHERE `lecturer` = '$name');";
                                            $result = $mysqli->query($query);
                                                                                        
                                            if($result){
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){                                                
                                        ?>   
                                                    <form action="TeachingStaffAllocate_engine.php" method="post">
                                                        <tr>        
                                                            <td><input type="hidden" name="Unit" /><?php echo $row['unit_code'];?><?php echo $row['unit_name'];?></td>
                                                            <td><input type="hidden" name="Email" value="<?php echo $row['Email'];?>"/><?php echo $row['Email'];?></td>
                                                            <td><input type="hidden" name="Campus" value="<?php echo $row['Campus'];?>"/><?php echo $row['Campus'];?></td>
                                                            <td><input type="hidden" name="Semester" value="<?php echo $row['Semester'];?>"/><?php echo $row['Semester'];?></td>
                                                        </tr>  
                                                    </form>
                                            <?php
                                                }
                                            }else{
                                                //handly error
                                                echo "Select enrolled unit student wrong!";
                                                }
                                            ?>
                                    </table>   
                                </div>
                            </div>
                            
                            <!--Lecturer Third tab-->
                            <div class="tab-pane fade" id="EnrolDetails" role="tabpanel" aria-labelledby="list-profile-list">
                                <div class="table-responsive">
                                    <table class="table table-hover table-active">
                                        <?php
                                            $Tutorialquery = "SELECT * FROM `Enrol_Tutorials` WHERE `unit_code` IN (SELECT `unit_code` FROM `Lectures` WHERE `lecturer` = '$name');";
                                            $Tutorialresult = $mysqli->query($Tutorialquery);                                                                                   
                                            if($Tutorialresult){
                                                echo'<thead>';
                                                echo'<tr class="text-left">';
                                                echo"<th>Activity</th>";
                                                echo"<th>Enrolled Student</th>";                                           
                                                echo"<th>Tutor</th>";
                                                echo"<th>Start Time</th>";
                                                echo"<th>End Time</th>";
                                                echo"<th>Day</th>";
                                                echo"<th>Location</th>";
                                                echo"</tr></thead>";
                                                            
                                                while ($row = $Tutorialresult->fetch_array(MYSQLI_ASSOC)){  
                                        ?>
                                                    <form action="TutorAllocate_engine.php" method="post">
                                                        <tr>
                                                            <td><input type="hidden" name="Activity" value="<?php echo $row['Activity'];?>"/><?php echo $row['Activity'];?></td>
                                                            <td><input type="hidden" id="Email" name="Email" value="<?php echo $row['Email'];?>"/><?php echo $row['Email'];?></td>
                                                            <td><input type="hidden" name="Tutor" value="<?php echo $row['Tutor'];?>"/><?php echo $row['Tutor'];?></td>                                                      
                                                            <td><input type="hidden" name="Start_time" value="<?php echo $row['Start_time'];?>"/><?php echo $row['Start_time'];?></td>
                                                            <td><input type="hidden" name="End_time" value="<?php echo $row['End_time'];?>"/><?php echo $row['End_time'];?></td>
                                                            <td><input type="hidden" name="Day" value="<?php echo $row['Day'];?>"/><?php echo $row['Day'];?></td>
                                                            <td><input type="hidden" name="Location" value="<?php echo $row['Location'];?>"/><?php echo $row['Location'];?></td>
                                                        </tr>  
                                                    </form>

                                            <?php
                                                
                                                }
                                            }else{
                                                //handly error
                                                echo "Tutorial enrolled students select Wrong!";
                                            }
                                            ?>
                                            
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            <?php
            }
            ?>

            <!--If user Role is Tutor, the will display my account, Tutorials Enrolled Student List for her/his tutoring class-->
            <?php if ($_SESSION['session_Role'] == 'Tutor'){
            ?>
                <div class="row">
                    <!--Two tabs in side Navigation-->
                    <div class="col-3">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-myaccount-list" data-toggle="list" href="#myaccount" role="tab" aria-controls="myaccount">My Account</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#Student-Management" role="tab" aria-controls="profile">Student Management</a>
                        </div>
                    </div>
                        
                    <div class="col-9">
                        <div class="tab-content" id="nav-tabContent">
                            <!--Tutor First tab (Profile Tab)-->
                            <div class="tab-pane fade show active" id="myaccount" role="tabpanel" aria-labelledby="list-myaccount-list">
                                <!--Button for change password-->
                                <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#changepassword_modal">Change Password</button><br><br>
                                    
                                <!--Tutor update personal information section-->
                                <div class="table-responsive">
                                    <table class="table table-hover table-active" id="useraccount_table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Staff ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>                         
                                                <th scope="col">Birth</th>
                                                <th scope="col">Edit</th>                            
                                            </tr>
                                        </thead>
                                            
                                        <?php
                                            $query = "SELECT * FROM `Users` WHERE `Email`= '$emailaddress';";
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
                            
                            <!--Tutor Second tab-->
                            <div class="tab-pane fade" id="Student-Management" role="tabpanel" aria-labelledby="list-home-list">
                                <div class="table-responsive">
                                    <table class="table table-hover table-active">
                                        <?php
                                            $Tutorialquery = "SELECT * FROM `Enrol_Tutorials` WHERE `Tutor` LIKE '%$name%';";
                                            $Tutorialresult = $mysqli->query($Tutorialquery);                                                                                   
                                            if($Tutorialresult){
                                                echo'<thead>';
                                                echo'<tr class="text-left">';
                                                echo"<th>Unit</th>";
                                                echo"<th>Activity</th>";
                                                echo"<th>Enrolled Student</th>";
                                                echo"<th>Start Time</th>";
                                                echo"<th>End Time</th>";
                                                echo"<th>Day</th>";
                                                echo"<th>Location</th>";
                                                echo"</tr></thead>";                                            
                                                while ($row = $Tutorialresult->fetch_array(MYSQLI_ASSOC)){  
                                            ?>
                                                    <form action="TutorAllocate_engine.php" method="post">
                                                        <tr>
                                                            <td><input type="hidden" id="unit_code" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?><?php echo $row['unit_name'];?></td>
                                                            <td><input type="hidden" name="Activity" value="<?php echo $row['Activity'];?>"/><?php echo $row['Activity'];?></td>
                                                            <td><input type="hidden" id="Email" name="Email" value="<?php echo $row['Email'];?>"/><?php echo $row['Email'];?></td>                                                      
                                                            <td><input type="hidden" name="Start_time" value="<?php echo $row['Start_time'];?>"/><?php echo $row['Start_time'];?></td>
                                                            <td><input type="hidden" name="End_time" value="<?php echo $row['End_time'];?>"/><?php echo $row['End_time'];?></td>
                                                            <td><input type="hidden" name="Day" value="<?php echo $row['Day'];?>"/><?php echo $row['Day'];?></td>
                                                            <td><input type="hidden" name="Location" value="<?php echo $row['Location'];?>"/><?php echo $row['Location'];?></td>                                                                                                            
                                                        </tr>  
                                                    </form>    

                                                <?php
                                                    
                                                }
                                            }else{
                                                //handly error
                                                echo "Tutorial enrolled students select Wrong!";
                                            }
                                            ?>
                                                
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

            
            
            
        </div>
        
        <br><br><br><br>   

        <!-- Footer -->
        <?php include('Footer.php'); ?>
        
       
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- TableEidt script-->
        <script src="../JS/jquery.tabledit.js"></script>
        <script src="../JS/jquery.tabledit.min.js"></script>

        <!--Use external js files for login form validate and doing other function-->
        <script type="text/javascript" src="../JS/UserAccount.js"></script>



    </body>
</html>