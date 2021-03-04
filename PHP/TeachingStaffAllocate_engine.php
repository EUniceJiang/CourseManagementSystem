<?php
//This page is about allocate lecturer for lecture and edit other lectures' details database engine (for AllocateTeachingStaff.php page)
    
    //db connection
    include('db_conn.php'); 
    
    //Receive the unit code data from the form (in AllocateTeachingStaff.php)
    if (isset($_POST['unit_code'])){
        //store in variables
        $unit_code = $_POST['unit_code'];
    }
    else{
        // Handle the error 
        echo 'Did not get the unit code!';
        exit();
    }

    //Receive the unit name data from the form (in AllocateTeachingStaff.php)
    if (isset($_POST['unit_name'])){
        //store in variables
        $unit_name = $_POST['unit_name'];
    }
    else{
        // Handle the error 
        echo 'Did not get the unit name!';
        exit();
    }

    //Receive the lecturer data from the form (in AllocateTeachingStaff.php)
    if (isset($_POST['lecturer'])){
        //store in variables
        $lecturer = $_POST['lecturer'];
    }
    else{
        // Handle the error 
        echo 'Did not get the lecturer!';
        exit();
    }

    //Receive the start time data from the form (in AllocateTeachingStaff.php)
    if (isset($_POST['start_time'])){
        //store in variables
        $start_time = $_POST['start_time'];
    }
    else{
        // Handle the error 
        echo 'Did not get the start time!';
        exit();
    }

    //Receive the end time data from the form (in AllocateTeachingStaff.php)
    if (isset($_POST['end_time'])){
        //store in variables
        $end_time = $_POST['end_time'];
    }
    else{
        // Handle the error 
        echo 'Did not get the end time!';
        exit();
    }

    //Receive the day data from the form (in AllocateTeachingStaff.php)
    if (isset($_POST['day'])){
        //store in variables
        $day = $_POST['day'];
    }
    else{
        // Handle the error 
        echo 'Did not get the day!';
        exit();
    }

    //Receive the location data from the form (in AllocateTeachingStaff.php)
    if (isset($_POST['Location'])){
        //store in variables
        $Location = $_POST['Location'];
    }
    else{
        // Handle the error 
        echo 'Did not get the day!';
        exit();
    }

    //SQL query to update data to Lectures table
    $Updatequery="UPDATE `Lectures` SET `lecturer`= '$lecturer',`start_time`='$start_time',`end_time`='$end_time',`day`='$day', `Location`='$Location' WHERE unit_code='$unit_code';";    

    $UpdatequeryResult = $mysqli->query($Updatequery);

    if(!UpdatequeryResult){
        //handly error
        echo "Something Wrong!";
        
    }else{

        //Alert Data Update successfully and keep in AllocateTeachingStaff.php page
        echo "<script type=\"text/javascript\">window.alert('Update Succeefully!');
        window.location.href = './AllocateTeachingStaff.php';</script>";   
    }
    
    // Close the connection
    $mysqli->close();

?>
   