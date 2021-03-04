<?php
//This file is about students enrol tutorial class database engine (For Tutorial_Allocation.php page)
    
    //db connection
    include('db_conn.php'); //db connection
    
    //Receive the tutorial activity id data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['activity_id'])){

        //store in variables
        $activity_id = $_POST['activity_id'];
    }
    else{
        // Handle the error 
        echo 'Did not get the Activity ID!';
        exit();
    }

    //Receive the tutorial activity data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Activity'])){

        //store in variables
        $Activity = $_POST['Activity'];
    }
    else{
        // Handle the error 
        echo 'Did not get the Activity!';
        exit();
    }

    //Receive the tutorial class capacity data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Capacity'])){

        //store in variables
        $Capacity = $_POST['Capacity'];
    }
    else{
        // Handle the error 
        echo 'Did not get the Capacity!';
        exit();
    }

    //Receive the tutorial unit code data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['unit_code'])){

        //store in variables
        $unit_code = $_POST['unit_code'];
    }
    else{
        // Handle the error 
        echo 'Did not get the unit code!';
        exit();
    }

    //Receive the tutorial unit name data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['unit_name'])){

        //store in variables
        $unit_name = $_POST['unit_name'];
    }
    else{
        // Handle the error 
        echo 'Did not get the unit name!';
        exit();
    }

    //Receive the tutorial day data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Day'])){

        //store in variables
        $Day = $_POST['Day'];
    }
    else{
        // Handle the error 
        echo 'Did not get the Day!';
        exit();
    }

    //Receive the campus data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Campus'])){

        //store in variables
        $Campus = $_POST['Campus'];
    }
    else{
        // Handle the error 
        echo 'Did not get the Campus!';
        exit();
    }

    //Receive the tutorial class location data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Location'])){

        //store in variables
        $Location = $_POST['Location'];
    }
    else{
        // Handle the error 
        echo 'Did not get the location!';
        exit();
    }

    //Receive the tutorial class tutor data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Tutor'])){

        //store in variables
        $Tutor = $_POST['Tutor'];
    }
    else{
        // Handle the error 
        echo 'Did not get the tutor!';
        exit();
    }

    //Receive the tutorial class start time data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Start_time'])){

        //store in variables
        $Start_time = $_POST['Start_time'];
    }
    else{
        // Handle the error 
        echo 'Did not get the start time!';
        exit();
    }

    //Receive the tutorial end time data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['End_time'])){

        //store in variables
        $End_time = $_POST['End_time'];
    }
    else{
        // Handle the error 
        echo 'Did not get the end time!';
        exit();
    }

    //Receive the current user email data 
    if (isset($_POST['session_user'])){

        //store in variables
        $session_user = $_POST['session_user'];
    }
    else{
        // Handle the error 
        echo 'Did not get the session_user!';
        exit();
    }

    //Receive the tutorial current enrol number data from the form (in Tutorial_Allocation.php)
    if (isset($_POST['Enrol_Number'])){

        //store in variables
        $Enrol_Number = $_POST['Enrol_Number'];
    }
    else{
        // Handle the error 
        echo 'Did not get the Enrol Number!';
        exit();
    }

    //SQL query to fetch related data to check whether the student have already enrol this unit tutorial class
    $Query = "SELECT * FROM `Enrol_Tutorials` WHERE `unit_code` = '$unit_code' AND `Email` = '$session_user';";
    
    //Execute query to the database and retrieve the result ($Selectresult)
    $Selectresult = $mysqli->query($Query);
    
    //Convert the Selectresult to array 
    $row=$Selectresult->fetch_array(MYSQLI_ASSOC);

    // The number of result rows
    $result_cnt = $Selectresult->num_rows;

    if (!$Selectresult){
        // handle error
        printf("Select Error", $mysqli->error);
        exit();
    }else{ 
        //Check whether the enrol tutorials already exist in the database
        if($result_cnt != 0){
            //Automatically go back to tutorial allocation page and pass the alert message
            echo "<script type=\"text/javascript\">window.alert('You have already enrolled,Please enrol anthor unit tutorial');window.location.href = './Tutorial_Allocation.php';</script>";
            exit(); 
        }else{
            //Below section is about checking the available enrol position 

            $EnrolNumberquery = "SELECT * FROM Tutorials WHERE `Activity` = '$Activity';";
            $EnrolNumberresult = $mysqli->query($EnrolNumberquery);
            $EnrolNumberrow=$EnrolNumberresult->fetch_array(MYSQLI_ASSOC);
            $EnrolNumber = $EnrolNumberrow['Enrol_Number'];
            $Capacity = $EnrolNumberrow['Capacity'];
            
            
            if($EnrolNumberresult){
                //Check whether the enrolnumber is less than capacity number
                if($EnrolNumber < $Capacity){
                    //Current enrolled student count is less than capacity, then insert the data to Enrol_Tutorials table
                    // SQL query to insert the data into table
                    $insertQuery = "INSERT INTO `Enrol_Tutorials` (`Activity`,`unit_code`,`unit_name`,`Email`,`id`,`Day`,`Campus`,`Location`,`Tutor`,`Start_time`,`End_time`) VALUE ('$Activity','$unit_code','$unit_name','$session_user','$id','$Day','$Campus','$Location','$Tutor','$Start_time','$End_time');";
                    
                    //Execute query to the database and retrieve the result 
                    $result = $mysqli->query($insertQuery);
             
                    if (!$result){
                        // handle error
                        printf("Insert Error", $mysqli->error);
                        exit();
                    }else{ 
                        //The EnrolNumber plus 1
                        $EnrolNumber ++;

                        //Update the newsest EnrolNumber to Tutorial table
                        $Updatequery="UPDATE `Tutorials` SET `Enrol_Number`= '$EnrolNumber' WHERE `Activity` = '$Activity';";
                         
                        $UpdatequeryResult = $mysqli->query($Updatequery);
                        
                        //Alert Data add successfully message
                        echo "<script type=\"text/javascript\">window.alert('Add Succeefully!');window.location.href = './Tutorial_Allocation.php';</script>";             
                     }
                     
                }
                else{
                    //There is not position for student to allocate, output the Alert message and keep in Tutorial_Allocation Page
                    echo "<script type=\"text/javascript\">window.alert('Full Class! Please choose another class');window.location.href = './Tutorial_Allocation.php';</script>";
                    exit();

                }
            }
            else{
                //Handle error
                printf("Enrol Number Select Error", $mysqli->error);
                exit();

            }
            
        }
    }
    
    // Close the connection
    $mysqli->close();

?>
   