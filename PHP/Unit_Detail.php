<?php
    //db connection
    include('db_conn.php'); 

    //Starting session
    session_start();

    if(!isset($_SESSION['session_user'])){
        //Output alert "login required" and go to login page
        echo "<script type=\"text/javascript\">window.alert('Login Required!');window.location.href = './Login.php';</script>";
        exit();        
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
        <title>Unit Detail</title>
        
    </head>

    <body>            
        <!--Navigation Bar-->
        <div id="menu"> <?php include('StudentNav.php'); ?></div>

        <!--Header-->
        <div class ="container">
        <br>
            <h2 align ="center">Unit details</h2>
        </div>

        <!-- Header Buttons-->
        <div class="container">
            <!--Search Unit Button-->
            <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#search_modal">Search</button>

            <!--Button for going to Unit Enrolment Page-->
            <a class="btn btn-primary float-left" role="button" href="Unit_Enrollment.php">Go to Enrolment</a>
        </div>

        <br><br>

        <!--Search Modal Section-->
        <div id="search_modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Search</h5>
                    </div>

                    <div class="modal-body">  
                        <form id="search_form">
                            <div class="form-group">
                                <!--Search term input-->
                                <label>Search</label><br>
                                <input type="text" class="form-control" id="search_term">
                                <br><br>
                                <button type="button" class="btn btn-success" id="search_button">Search</button>
                            </div>    
                        </form>
                        
                        <!--Search output section-->
                        <div id="search_output"></div>  

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div> 
                </div>
            </div>           
        </div>

        <!--Unit details display section-->
        <div class = "container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-left">
                            <th>Unit Code</th>
                            <th>Unit Name</th>
                            <th>Unit Coordinator</th>
                            <th>Semester</th>
                            <th>Campus</th> 
                        </tr>
                    </thead>
            
                    <?php
                        //Query to retrieve all the unit details
                        $query = "SELECT * FROM `Units`;";
                        $result = $mysqli->query($query);
                        
                        if ($result){
                            //Use a loop to output a data row for each unit
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)){                   
                                echo '
                                <tr>
                                    <td>'.$row["unit_code"].'</td>
                                    <td>'.$row["unit_name"].'</td>
                                    <td>'.$row["unit_coordinator"].'</td>
                                    <td>'.$row["semester"].'</td>
                                    <td>'.$row["campus"].'</td>
                                </tr>                        
                                ';
                            }
                        }
                        else{
                            //handly error
                            echo "Something Wrong!";
                        }
                        
                        //close db connection
                        $mysqli->close();
                    ?>
                </table>
            </div>
        </div>
        
        <br><br><br><br>   
        <br><br><br><br>      
      
        <!-- Footer -->
        <?php include('Footer.php'); ?>
        
        <!--Optional JavaScript-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>        
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <!--Use external js files for search button action-->
        <script type="text/javascript" src="../JS/UnitDetail_Searchbtn.js"></script>

    </body>
</html>