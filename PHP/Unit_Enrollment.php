<?php
    //db connection
    include('db_conn.php'); 
    
    //Starting session
    session_start();

    //If the session for username has not been set, initialise it
    if(!isset($_SESSION['session_user'])){
        //Output alert "login required" and go to login page
        echo "<script type=\"text/javascript\">window.alert('Login Required!');window.location.href = './Login.php';</script>";
        exit();        
    }else{
        //Store in variables
        $emailaddress = $_SESSION['session_user'];

        //Only student can access this page
        if($_SESSION['session_Role'] != 'Student'){

            //Output alert message to user and go back to Home page
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
        <title>Unit Enrolment</title>
       
    </head>

    <body>            
        <!--Navigation Bar-->
        <div id="menu"> <?php include('StudentNav.php'); ?></div>

        <!--Main Content-->
        <div class="container">
            <br>

            <!--Header-->
            <div class="row" id="Welcometitle">
                <h2>Welcome to Unit Enrollment System</h2>
            </div>
            
            <br>

            <!--Show Already Enrolled Unit-->
            <div class="row">
                <div class="card w-100">
                    <div class="card-header">
                        <h4>Enrolled Unit</h4>
                    </div>
                    <div class="card-body">

                        <!--Button for going to Tutorial allocation page-->
                        <form class="form-inline mr-auto">
                            <a class="btn btn-outline-primary float-left" role="button" href="Tutorial_Allocation.php">Go to Tutorial Allocation</a>
                        </form>
                        <br>

                        <!--This section is about already enrolled units-->
                        <div class="table-responsive">
                            <div class="table">
                                <table>
                                    <?php
                                        //SQL query to select this user already enrolled units from 'Enrol_Units' table
                                        $SelectQuery = "SELECT * FROM `Enrol_Units` WHERE `Email`= '$emailaddress';";
                                        $result = $mysqli->query($SelectQuery);
                                        
                                            if($result){
                                                echo"<thead>";
                                                echo'<tr class="text-left">';
                                                echo"<th>Action</th>";
                                                echo"<th>Unit Code</th>";
                                                echo"<th>Unit Name</th>";
                                                echo"<th>Campus</th>";
                                                echo"<th>Semester</th>";
                                                echo"<th>Unit Coordinator Email</th>";
                                                echo"<th></th>";
                                                echo"</tr></thead>";
                                                
                                                //Use a loop to output a data row for each unit
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)){   
                                    ?>
                                                <form action="UnitWithdraw_engine.php" method="post">
                                                    <tr>
                                                        <td><input type="submit" name="Withdraw" value="Withdraw" class="btn btn-danger btn-sm"/></td>
                                                        <td><input type="hidden" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                        <td><input type="hidden" name="unit_name"value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="Campus"value="<?php echo $row['Campus'];?>"/><?php echo $row['Campus'];?></td>
                                                        <td><input type="hidden" name="Semester"value="<?php echo $row['Semester'];?>"/><?php echo $row['Semester'];?></td>
                                                        <td><input type="hidden" name="UC_Email" value="<?php echo $row['UC_Email'];?>"/><?php echo $row['UC_Email'];?></td>
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
            <br><br>
                                            
            <!--All units enrolment system -->
            <div class="row" id="Enrolment">
                <!--Using Bootstrap card container-->
                <div class="card w-100">
                    <div class="card-header">
                        <h4>Unit Enrollment</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Action</th>  
                                        <th scope="col">Unit Code</th>
                                        <th scope="col">Unit Name</th>
                                        <th scope="col">Campus</th>
                                        <th scope="col">Study Periods</th> 
                                        <th scope="col">Unit Coordinator</th> 
                                        <th scope="col">Unit Coordinator Email</th>
                                        <th scope="col"></th>  
                                                                              
                                    </tr>
                                </thead>
                                
                                <tbody>

                                    <?php
                                        //Query to retrieve all the unit details
                                        $query = "SELECT * FROM `Units`;";
                                        $result = $mysqli->query($query);
                                        
                                        if ($result){
                                            //Use a loop to output a data row for each unit
                                            while ($row = $result->fetch_array(MYSQLI_ASSOC)){ 
                                                
                                            ?>
                                                <form action="UnitEnrol_engine.php" method="post">
                                                    <tr>
                                                        <td><input type="submit" id="enrolbtn" name="enrol" value="Enrol" class="btn btn-outline-primary"/></td>
                                                        <td><input type="hidden" name="unit_code" value="<?php echo $row['unit_code'];?>"/><?php echo $row['unit_code'];?></td>
                                                        <td><input type="hidden" name="unit_name" value="<?php echo $row['unit_name'];?>"/><?php echo $row['unit_name'];?></td>
                                                        <td><input type="hidden" name="campus" value="<?php echo $row['campus'];?>"/><?php echo $row['campus'];?></td>
                                                        <td><input type="hidden" name="semester" value="<?php echo $row['semester'];?>"/><?php echo $row['semester'];?></td>
                                                        <td><input type="hidden" name="unit_coordinator" value="<?php echo $row['unit_coordinator'];?>"/><?php echo $row['unit_coordinator'];?></td>
                                                        <td><input type="hidden" name="UC_Email" value="<?php echo $row['UC_Email'];?>"/><?php echo $row['UC_Email'];?></td>                                                       
                                                        <td><input type="hidden" name="session_user" value="<?php echo $_SESSION['session_user'];?>"/></td>                                                        
                                                    </tr>  
                                                </form>

                                            <?php
                                            }
                                        }
                                        else{
                                            //handly error
                                            echo "Something Wrong!";
                                        }
                                        
                                        //close db connection
                                        $mysqli->close();
                                    ?>
                                    
                                </tbody>                                
                                    
                            </table>
                        </div>
                    </div>
                </div>            
            </div>
            <br>
            
        </div>
        <br><br><br><br>   

        
        <!-- Footer -->
        <?php include('Footer.php'); ?>
    
        <!-- JavaScript-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!--jQuery first, then Poper.js, then Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
</html>