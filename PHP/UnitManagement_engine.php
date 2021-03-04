<?php
//This .php is about Unit_Management.php page "Add New Unit" button, delete or eidt details datatase engine 
     
    //db connection
    include('db_conn.php'); 

    
    //From line 8 to 16 are about edit or detete unit details
    $input = filter_input_array(INPUT_POST);
    
    //Different query will be excute depends on which button DC choose, edit or delete
    if ($input['action'] == 'edit') {
        $mysqli->query("UPDATE `Units` SET unit_code='" . $input['unit_code'] . "', unit_name='" . $input['unit_name'] . "', unit_coordinator='" . $input['unit_coordinator'] . "', semester='" .$input['semester']."', campus='" .$input['campus']."', Unit_description='" . $input['Unit_description'] . "' WHERE unit_code='" . $input['unit_code'] . "'");
    } else if ($input['action'] == 'delete') {
        $mysqli->query("DELETE FROM `Units` WHERE unit_code='" . $input['unit_code'] . "'");
    } 
    
    
    //Below codes are about add a new unit 
    //receive the unit_code data from the form (in Unit_Management.php)
    if (isset($_POST['unitcode'])){
        
        //store in variables
        $unitcode = $_POST['unitcode'];
    }
    else{
        // Handle the error 
        echo 'Did not get the unitcode!';
        exit();
    }

    //receive the unit_name data from the form (in Unit_Management.php)
    if (isset($_POST['unitname'])){

        //store in variables
        $unitname = $_POST['unitname'];
    }
    else{
        // Handle the error 
        echo 'Did not get the unitname!';
        exit();
    }

    //receive the unit coordinator data from the form (in Unit_Management.php)
    if (isset($_POST['unitcoordinator'])){

        //store in variables
        $unitcoordinator = $_POST['unitcoordinator'];
    }
    else{
        // Handle the error 
        echo 'Did not get the unit coordinator!';
        exit();
    }

    //receive the semester data from the form (in Unit_Management.php)
    if (isset($_POST['semester'])){

        //store in variables
        $semester = $_POST['semester'];
    }
    else{
        // Handle the error 
        echo 'Did not get the semester!';
        exit();
    }

    //receive the campus data from the form (in Unit_Management.php)
    if (isset($_POST['campus'])){

        //store in variables
        $campus = $_POST['campus'];
    }
    else{
        // Handle the error 
        echo 'Did not get the campus!';
        exit();
    }

    //receive the unit description data from the form (in Unit_Management.php)
    if (isset($_POST['Unit_description'])){

        //store in variables
        $Unit_description = $_POST['Unit_description'];
    }
    else{
        // Handle the error 
        echo 'Did not get the description!';
        exit();
    }


    //SQL query to check whether is unit already existing in database after getting all data and store in variables
    $query = "SELECT * FROM `Units` WHERE `unit_code`='$unitcode';";
    
    //Execute query to the Units table and retrieve the result 
    $selectresult = $mysqli->query($query);
    
    //convert the selectresult to array 
    $row=$selectresult->fetch_array(MYSQLI_ASSOC);
        
    //The number of rows
    $result_cnt = $selectresult->num_rows;
    
    if($selectresult){
        //If the row count is zero, then insert the new unit data into database
        if($result_cnt == 0){
   
            // SQL query to insert the data into table
            $insertQuery = "INSERT INTO `Units` (`unit_code`,`unit_name`,`unit_coordinator`,`semester`,`campus`,`Unit_description`) VALUE ('$unitcode','$unitname','$unitcoordinator','$semester','$campus','$Unit_description');";
            
            //Execute query to the Units table and retrieve the result 
            $result = $mysqli->query($insertQuery);
            
            if (!$result){
                // handle error
                printf("Insert Error", $mysqli->error);
                exit();
            }else{ 
                //Alert Data add successfully
                echo "<script type=\"text/javascript\">window.alert('Add Unit Succeefully!');window.location.href = './Unit_Management.php';</script>";    
            }
        }else{
            // handle error
            echo "<script type=\"text/javascript\">window.alert('Alreay exits this unit, unit name should be unique!');window.location.href = './Unit_Management.php';</script>";    

        }
    }else{
        // handle error
        echo "Select unit wrong!";

    }


    // Close the connection
    $mysqli->close();

?>
   