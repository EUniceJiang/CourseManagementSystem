<?php
//This page is about Unit withdraw function database engine (For Unit_Enrollment.php page)
    
    //db connection
    include('db_conn.php'); 
    
    //Receive the unit code data from the form (in Unit_Enrollment.php)
    if (isset($_POST['unit_code'])){
        //Store in variables
        $unit_code = $_POST['unit_code'];
        
    }
    else{
        //Handle the error 
        echo 'Did not get the unit code!';
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

    //Delete data from Enrol_Units table 
    $mysqli->query("DELETE FROM `Enrol_Units` WHERE `unit_code` = '$unit_code' AND `Email` = '$session_user';");
    

    //Check whether this row data still in Enrol_Units table
    //Try to select this row data from Enrol_Units table
    $Query = "SELECT * FROM `Enrol_Units` WHERE `unit_code` = '$unit_code' AND `Email` = '$session_user';";

    //Execute query to the database and retrieve the result ($Selectresult)
    $Selectresult = $mysqli->query($Query);
    
    //Convert the Selectresult to array 
    $row=$Selectresult->fetch_array(MYSQLI_ASSOC);

    //The number of rows
    $result_cnt = $Selectresult->num_rows;

    //Check whether have select result
    if($result_cnt != 0){
        //automatically go back to Unit Enrollment page and pass the error message
        echo "<script type=\"text/javascript\">window.alert('delete error');window.location.href = './Unit_Enrollment.php';</script>";
        exit(); 
    }else{    
        //Alert data detele successfully and keep in Unit_Enrollment.php page
        echo "<script type=\"text/javascript\">window.alert('Withdraw Succeefully!');window.location.href = './Unit_Enrollment.php';</script>";                         
    }

    // Close the connection
    $mysqli->close();

?>
   