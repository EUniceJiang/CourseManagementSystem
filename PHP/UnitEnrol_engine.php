<?php
//This file is about Unit enrollment database engine (for Unit_Enrollment.php page )

    //db connection
    include('db_conn.php'); 

    //Receive the unit code data from the form (in Unit_Enrollment.php)
    if (isset($_POST['unit_code'])){
        //Store in variables
        $unit_code = $_POST['unit_code'];
    }
    else{
        //Handle the error 
        echo 'Did not get the unit_code!';
        exit();
    }

    //Receive the unit name data from the form (in Unit_Enrollment.php)
    if (isset($_POST['unit_name'])){
        //Store in variables
        $unit_name = $_POST['unit_name'];
    }
    else{
        //Handle the error 
        echo 'Did not get the unit_name!';
        exit();
    }

    //Receive the UC Email data from the form (in Unit_Enrollment.php)
    if (isset($_POST['UC_Email'])){
        //Store in variables
        $UC_Email = $_POST['UC_Email'];
    }
    else{
        //Handle the error 
        echo 'Did not get the UC Email!';
        exit();
    }

    //Receive the semester data from the form (in Unit_Enrollment.php)
    if (isset($_POST['semester'])){
        //Store in variables
        $semester = $_POST['semester'];
    }
    else{
        //Handle the error 
        echo 'Did not get the semester!';
        exit();
    }

    //Receive the campus data from the form (in Unit_Enrollment.php)
    if (isset($_POST['campus'])){
        //Store in variables
        $campus = $_POST['campus'];
    }
    else{
        //Handle the error 
        echo 'Did not get the campus!';
        exit();
    }

    //Receive the session_user data 
    if (isset($_POST['session_user'])){
        //Store in variables
        $session_user = $_POST['session_user'];
    }
    else{
        //Handle the error 
        echo 'Did not get the session_user!';
        exit();
    }

    //SQL query to fetch data about current session user have enrolled units
    $Query = "SELECT * FROM `Enrol_Units` WHERE `unit_code` = '$unit_code' AND `Email` = '$session_user';";
    
    //Execute query to the database and retrieve the result ($Selectresult)
    $Selectresult = $mysqli->query($Query);
    
    //Convert the Selectresult to array 
    $row=$Selectresult->fetch_array(MYSQLI_ASSOC);

    //The number of rows
    $result_cnt = $Selectresult->num_rows;

    if (!$Selectresult){
        //Handle error
        printf("Select Error", $mysqli->error);
        exit();
    }else{ 
        //Check whether the enrol unit already exist in the database
        if($result_cnt != 0){
            //Automatically go back to unit enrolment page and pass the message
            echo "<script type=\"text/javascript\">window.alert('Already Enrol,Please enrol anthor unit!');window.location.href = './Unit_Enrollment.php';</script>";
            exit(); 
        }else{
            //If didn't find same unit in the database, then insert data to the table
            //SQL query to insert the data into table
            $insertQuery = "INSERT INTO `Enrol_Units` (`unit_code`,`unit_name`,`Email`,`UC_Email`,`Semester`,`Campus`) VALUE ('$unit_code','$unit_name','$session_user','$UC_Email','$semester','$campus');";
        
            //Execute query to the database and retrieve the result 
            $result = $mysqli->query($insertQuery);
            
            //Handle error
            if (!$result){
                printf("Insert Error", $mysqli->error);
                exit();
            }else{ 
                //Alert record add successfully and keep in Unit_Enrollment.php page
                echo "<script type=\"text/javascript\">window.alert('Enrol Succeefully!');
                window.location.href = './Unit_Enrollment.php';</script>";             
            }
        }
    }
    
    // Close the connection
    $mysqli->close();

?>
   