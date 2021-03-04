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
        //Only DC can access this page
        if($_SESSION['session_Role'] != 'DC'){
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

        <title>Academic Staff Management</title>
        
    </head>

    <body>            
        <!--Navigation Bar-->
        <div id="menu"><?php include('StaffNav.php'); ?></div>

        <br>

        <!--Header-->
        <div class ="container">
            <h2 align ="center">Manage Staff Details</h2>
        </div>
        <br><br>

        <!--Header Buttons-->
        <div class="container">
            <!--Go Back Button-->
            <a class="btn btn-dark float-left" href="./Home.php" role="button"> Go Back</a>
            <!--Search Form-->
            <form class="form-inline float-right" id="search_form" action>
                <div class="form-group">
                    <input type="text" class="form-control" id="search_term" placeholder="Any Words">&nbsp;
                    <button type="button" class="btn btn-success" id="search_button">Search</button>&nbsp;
                    <button type="button" class="btn btn-success" id="close_button">Close</button>
                </div>
            </form>
                     
        </div>
        <br><br>

        <!--Search result section-->
        <div class="container">
            <div id="search_output">     
            </div>     
        </div> 

        <!--Master academic staff list-->
        <div class="container">
            <div class="card w-100">
                <div class="card-header">
                    <h4>Acedemic Staff Management List</h4>                        
                </div>

                <div class="card-body">
                    <!--Add New Staff Button-->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#NewStaff">Add New Staff</button>
                    <br><br>

                    <!--Staff List Table-->
                    <div class="table-responsive">
                        <table class="table" id="AcademicStaff_table">
                            <thead>
                                <tr class="text-left">
                                    <th scope="col">Staff ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Qualification</th>
                                    <th scope="col">Expertise</th>
                                    <th scope="col">Consultation</th>
                                    <th scope="col">Teaching Unit</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>                          
                                </tr>
                            </thead>

                            <?php
                                //query to retrieve all the staff details
                                $query = "SELECT * FROM `Users` WHERE `Role_Level` != 'Student';";
                                
                                //Execute query to the Users table and retrieve the result 
                                $result = $mysqli->query($query);
                                    
                                if ($result){
                                    //produce the output
                                    //Use a loop to output a data row for each staff
                                    while ($row = $result->fetch_array(MYSQLI_ASSOC)){                   
                                        echo '
                                            <tbody>
                                                <tr>
                                                    <td>'.$row["user_id"].'</td>
                                                    <td>'.$row["user_name"].'</td>
                                                    <td>'.$row["Email"].'</td>
                                                    <td>'.$row["Qualification"].'</td>
                                                    <td>'.$row["Expertise"].'</td>
                                                    <td>'.$row["Consultation"].'</td>
                                                    <td>'.$row["Teach_Unit"].'</td>
                                                    <td>'.$row["Role_Level"].'</td>    
                                                </tr>    
                                            </tbody>                    
                                            ';

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
            </div>
                             
            <br>
            
            <!--This section is about create a new staff information-->
            <div class="modal fade" id="NewStaff" role="dialog">
                <!--Set popup windows in center position-->
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Create a new staff</h5>
                        </div>

                        <!--Create a new staff Form-->
                        <div class="modal-body">
                            <form method="post" onsubmit="return formvalidate();" action="AddStaff_engine.php">    
                                
                                <!--Staff Name Input-->
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input class="form-control-sm" type="text" id="user_name" name="user_name">
                                </div>

                                <!--Staff ID Input-->
                                <div class="form-group">
                                    <label>Staff ID:</label>
                                    <input class="form-control-sm" type="text" id="user_id" name="user_id">
                                </div>

                                <!--Staff Email Input-->
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control-sm" type="text" id="Email" name="Email">
                                </div>

                                <!--Staff Qualification Input-->
                                <div class="form-group">
                                    <label>Qualification:</label>
                                    <input class="form-control-sm" type="text" id="Qualification" name="Qualification">
                                </div>

                                <!--Staff Expertise Input-->
                                <div class="form-group">
                                    <label>Expertise:</label>
                                    <input class="form-control-sm" type="text" id="Expertise" name="Expertise">
                                </div>
                                
                                <!--Staff Consultation Hours Input-->
                                <div class="form-group">
                                    <label>Consultation Hours:</label>
                                    <input class="form-control-sm" type="text" id="Consultation" name="Consultation">
                                </div>

                                <!--Staff Teaching Unit Select, value from Units table in database-->
                                <div class="form-group">
                                    <label>Teaching Unit:</label>
                                    <select class="btn btn-outline-info" id="Teach_Unit" name="Teach_Unit">
                                        <option value="notSelect">No Select</option>  
                                        <?php
                                            //SQL query to select unit_code
                                            $SelectQuery = "SELECT * FROM `Units` ORDER BY `unit_code`;";
                                        
                                            //execute query to the database and retrieve the result
                                            $result = $mysqli->query($SelectQuery);

                                            if($result){
                                                while($row = $result->fetch_array(MYSQLI_ASSOC)){

                                        ?>
                                                <option value="<?php echo $row['unit_code'];?>"><?php echo $row['unit_code'];?></option>  

                                        <?php 
                                                }
                                            }else{
                                                echo "Unit code select wrong!";
                                                }
                                            //close db connection
                                            $mysqli->close();

                                        ?>
                                    </select>
                                 
                                </div>
                                
                                <!--Staff Role Selection Box -->
                                <div class="form-group">
                                    <label>Role:</label>    
                                    <select class="btn btn-outline-info" id="Role" name="Role">
                                        <option value="notSelect">No Select</option>  
                                        <option value="UC">UC</option> 
                                        <option value="Lecturer">Lecturer</option>  
                                        <option value="Tutor">Tutor</option>  
                                    </select>
                                </div>

                                <!--Add New Staff Form Submit Button-->
                                <input type="submit" name="submit" value="submit" class="btn btn-danger">             
                            </form>

                        </div>
                                              
                        <div class="modal-footer"> 
                            <!--Button for closing modal-->
                            <button type="button" class="btn btn-success" id="close_button" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <br><br><br><br><br><br><br><br>   

        <!-- Footer -->
        <?php include('Footer.php'); ?>
        
      
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
        <!--TableEdit Plugin Script-->
        <script src="../JS/jquery.tabledit.js"></script>
        <script src="../JS/jquery.tabledit.min.js"></script>

        <!--Use external js files for achiving other functions-->        
        <script type="text/javascript" src="../JS/AcademicStaff_Edit.js"></script>

    </body>
</html>