<?php
    //db connection
    include('db_conn.php'); 

    //starting session
    session_start();

    //if the session for user has not been set, initialise it
    if(!isset($_SESSION['session_user'])){
        //output alert "login required" and go to login page
        echo "<script type=\"text/javascript\">window.alert('Login Required!');window.location.href = './Login.php';</script>";
        exit();        
    }else{
        //Only DC can access this page, check users' role
        if($_SESSION['session_Role'] != 'DC'){
            //output access deny message and go back to home page
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

        <!--Titile-->
        <title>Unit Management</title>
        
    </head>

    <body>   
        <!--Navigation Bar-->
        <div id="menu"> <?php include('StaffNav.php'); ?></div>
        <br>

        <!--Main Content-->
        <div class ="container">
            <!--Header-->
            <h2 align ="center">Manage Unit details</h2>
        </div>

        <br><br>

        <!--Header Buttons-->
        <div class="container">
            <!--Go Back Button-->
            <a class="btn btn-dark float-left" href="./Home.php" role="button"> Go Back</a>

            <!--Search Form-->
            <form class="form-inline float-right" id="search_form">
                <div class="form-group">
                    <input type="text" class="form-control" id="search_term" placeholder="Any Words">&nbsp;
                    <button type="button" class="btn btn-success" id="search_button">Search</button>&nbsp;
                    <button type="button" class="btn btn-success" id="close_button">Close</button>
                </div>
            </form>                     
        </div>

        <br><br>

        <!--Search result output section-->
        <div class="container">
            <div id="search_output"></div>     
        </div>         

       <br>

        <!--This section is about all units' detail, DC can remove or edit units' information.-->
        <div class="container">
            <!--Use Bootstrap card to display data--> 
            <div class="card w-100">
                <div class="card-header">
                    <h4>All Units </h4>
                </div>

                <div class="card-body">
                    <!--Add New Unit Button-->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#unitAdd_modal">Add New Unit</button>
                    <br><br>
                    
                    <!--All units information-->
                    <div class="table-responsive">
                        <table id="manage_table" class="table">
                            <!--Table Header-->
                            <thead>
                                <tr class="text-left">
                                    <th scope="col">Unit Code</th>
                                    <th scope="col">Unit Name</th>
                                    <th scope="col">Unit Coordinator</th>
                                    <th scope="col">Semester</th>                         
                                    <th scope="col">Campus</th>
                                    <th scope="col">Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <?php
                                //Query to retrieve all the unit details from Units table
                                $query = "SELECT * FROM `Units`;";

                                //Execute query to the Units table and store to the result 
                                $result = $mysqli->query($query);
                                
                                if ($result){
                                    //Use a loop to output a data row for each unit
                                    while ($row = $result->fetch_array(MYSQLI_ASSOC)){                   
                                        echo '
                                        <tbody>
                                            <tr class="text-left">         
                                                <td>'.$row["unit_code"].'</td>
                                                <td>'.$row["unit_name"].'</td>
                                                <td>'.$row["unit_coordinator"].'</td>
                                                <td>'.$row["semester"].'</td>
                                                <td>'.$row["campus"].'</td>
                                                <td>'.$row["Unit_description"].'</td>
                                                
                                                
                                            </tr>  
                                        </tbody>                      
                                        ';
                                    }
                                }
                                else{
                                    //handly error
                                    echo "Select query wrong!";
                                }
                    
                                //close db connection
                                $mysqli->close();

                            ?>
                        </table>
                    </div>  
                </div>     
            </div>


        <!--Add a unit details section-->
        <div id="unitAdd_modal" class="modal fade" role=dialog">
            <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Unit</h5>
                            </div>

                            <!--New unit add form-->
                            <div class="modal-body">
                                <form method="post" action="UnitManagement_engine.php" onsubmit="return formvalidate();">
                                    
                                    <!--Unit code input -->
                                    <div class="form-group">
                                        <lable for="unitcode">Unit Code:</lable>
                                        <input type="text" id="unitcode" name="unitcode" class="form-control">
                                    </div>

                                    <!--Unit name input -->
                                    <div class="form-group">
                                        <lable for="unitname">Unit Name:</lable>
                                        <input type="text" id="unitname" name="unitname" class="form-control">    
                                    </div>

                                    <!--Unit Coordinator input -->
                                    <div class="form-group">
                                        <lable for="unitcoordinator">Unit Coordinator:</lable>
                                        <input type="text" id="unitcoordinator" name="unitcoordinator" class="form-control">
                                    </div>

                                    <!--Unit Semester input -->
                                    <div class="form-group">
                                        <lable for="semester">Semester:</lable>
                                        <input type="text" id="semester" name="semester" class="form-control">
                                    </div>
                                    
                                    <!--Campus input -->
                                    <div class="form-group">
                                        <lable for="campus">Campus:</lable>
                                        <input type="text" id="campus" name="campus" class="form-control">
                                    </div>

                                    <!--Unit description input -->
                                    <div class="form-group">
                                        <lable for="Unit_description">Description:</lable>
                                        <input type="text" id="Unit_description" name="Unit_description" class="form-control">
                                    </div>

                                    <!--Submit button-->
                                    <input type="submit" name="submit" value="submit" class="btn btn-danger">
                                    
                                </form>
                            </div>

                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-success" id="close_button" data-dismiss="modal">Close</button>
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

        <!-- TableEidt Script-->
        <script src="../JS/jquery.tabledit.js"></script>
        <script src="../JS/jquery.tabledit.min.js"></script>
        
        <!--Use external js files for Add a unit form validate and doing other function-->
        <script type="text/javascript" src="../JS/Unit_Master.js"></script>
        <script type="text/javascript" src="../JS/MasterUnit_Edit.js"></script>
        
    </body>
</html>