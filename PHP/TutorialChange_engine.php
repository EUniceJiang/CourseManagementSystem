<?php
//This file is about Withdraw a tutorial class function database engine (For Tutorial_Allocation.php page )
    
    //db connection
    include('db_conn.php'); 

    //Receive the tutorial activity data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Activity'])){
        //Store in variables
        $Activity = $_POST['Activity'];
        
    }
    else{
        //Handle the error 
        echo 'Did not get the Activity!';
        exit();
    }

    //Receive the session data 
    if (isset($_POST['session_user'])){
        //Store in variables
        $session_user = $_POST['session_user'];
      
    }
    else{
        //Handle the error 
        echo 'Did not get the session_user!';
        exit();
    }

    //Receive the tutorial enrol number data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Enrol_Number'])){
        //Store in variables
        $Enrol_Number = $_POST['Enrol_Number'];
      
    }
    else{
        //Handle the error 
        echo 'Did not get the Enrol Number!';
        exit();
    }

    //Delete a record from Enrol_Tutorials table 
    $mysqli->query("DELETE FROM `Enrol_Tutorials` WHERE `Activity` = '$Activity' AND `Email` = '$session_user';");
    
    //Check whether this row data still in Enrol_Tutorials table
    //Try to select this row data from Enrol_Tutorials table
    $Query = "SELECT * FROM `Enrol_Tutorials` WHERE `Activity` = '$Activity' AND `Email` = '$session_user';";

    //Execute query to the database and retrieve the result ($Selectresult)
    $Selectresult = $mysqli->query($Query);
    
    //Convert the Selectresult to array 
    $row=$Selectresult->fetch_array(MYSQLI_ASSOC);

    //The number of rows
    $result_cnt = $Selectresult->num_rows;

    //Check whether have select result
    if($result_cnt != 0){
        //automatically go back to Tutorial Allocation page and pass the error message
        echo "<script type=\"text/javascript\">window.alert('Delete error');window.location.href = './Tutorial_Allocation.php';</script>";
        exit(); 
    }else{
        //Enrol_Number count minus 1 if withdraw successfully
        $Enrol_Number --;
        
        //Update the newest Enrol_Number to the 'Tutorials' table
        $Updatequery="UPDATE `Tutorials` SET `Enrol_Number`= '$Enrol_Number' WHERE `Activity` = '$Activity';";

        //Execute query to the database and retrieve the result
        $UpdatequeryResult = $mysqli->query($Updatequery);

        //Alert Data detele successfully and keep in Tutorial_Allocation.php page
        echo "<script type=\"text/javascript\">window.alert('Remove Succeefully!');
        window.location.href = './Tutorial_Allocation.php';</script>";                         
    }
    
    // Close the connection
    $mysqli->close();

?>
   