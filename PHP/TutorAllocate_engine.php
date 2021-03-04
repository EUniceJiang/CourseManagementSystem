<?php
//This file is for Tutor Allocate database engine (for AllocateTeachingStaff.php page)
    
    //db connection
    include('db_conn.php'); 

    //Line 8 to 113 is about 'Update' button function in Tutorial Allocate tab, user can update tutorial information and allocate a tutor for a class.
    if(isset($_POST['edit'])){
        //Receive the unit code data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['unit_code'])){
            //Store in variables
            $unit_code = $_POST['unit_code'];
        }
        else{
            //Handle the error 
            echo 'Did not get the unit code!';
            exit();
        }

        //Receive the unit name from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['unit_name'])){
            //Store in variables
            $unit_name = $_POST['unit_name'];
        }
        else{
            // Handle the error 
            echo 'Did not get the unit name!';
            exit();
        }

        //Receive the activity data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Activity'])){
            //Store in variables
            $Activity = $_POST['Activity'];
        }
        else{
            //Handle the error 
            echo 'Did not get the activity!';
            exit();
        }

        //Receive the tutor data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Tutor'])){
            //Store in variables
            $Tutor = $_POST['Tutor'];
        }
        else{
            //Handle the error 
            echo 'Did not get the tutor!';
            exit();
        }

        //Receive the start time data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Start_time'])){
            //Store in variables
            $Start_time = $_POST['Start_time'];
        }
        else{
            // Handle the error 
            echo 'Did not get the start time!';
            exit();
        }

        //Receive the end time data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['End_time'])){
            //Store in variables
            $End_time = $_POST['End_time'];
        }
        else{
            //Handle the error 
            echo 'Did not get the end time!';
            exit();
        }

        //Receive the day data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Day'])){
            //Store in variables
            $Day = $_POST['Day'];
        }
        else{
            //Handle the error 
            echo 'Did not get the day!';
            exit();
        }

        //Receive the location data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Location'])){
            //Store in variables
            $Location = $_POST['Location'];
        }
        else{
            //Handle the error 
            echo 'Did not get the location!';
            exit();
        }

        //Query to update tutorials data 
        $Updatequery="UPDATE `Tutorials` SET `Tutor`= '$Tutor',`Start_time`='$Start_time',`End_time`='$End_time',`Day`='$Day', `Location`='$Location' WHERE unit_code='$unit_code';";    

        //Execute query to the Tutorials table and retrieve the result 
        $UpdatequeryResult = $mysqli->query($Updatequery);

        if(!UpdatequeryResult){
            //Handly error
            echo "Something Wrong!";
            
        }else{

            //Alert Data detele successfully and keep in AllocateTeachingStaff.php page
            echo "<script type=\"text/javascript\">window.alert('Update Succeefully!');
            window.location.href = './AllocateTeachingStaff.php';</script>";   
        }
    }
    
    //Line 117 to 155 is about 'Remove' button function in Tutorial Allocate tab, user can delete this tutorial class.
    if(isset($_POST['remove'])){
        //Receive the activity data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Activity'])){
            //Store in variables
            $Activity = $_POST['Activity'];
        }
        else{
            //Handle the error 
            echo 'Did not get the activity!';
            exit();
        }

        //Delete data from Tutorials table 
        $mysqli->query("DELETE FROM `Tutorials` WHERE `Activity` = '$Activity';");
        
        //Check whether this row data still in Tutorials table
        //Try to select this row data from Tutorials table
        $Query = "SELECT * FROM `Tutorials` WHERE `Activity` = '$Activity';";
        
        //execute query to the database and retrieve the result ($Selectresult)
        $Selectresult = $mysqli->query($Query);
        
        //convert the Selectresult to array 
        $row=$Selectresult->fetch_array(MYSQLI_ASSOC);

        // The number of rows
        $result_cnt = $Selectresult->num_rows;

        // check whether have select result
        if($result_cnt != 0){
            //Automatically go back to Tutorial Allocation page and pass the error message
            echo "<script type=\"text/javascript\">window.alert('delete error');window.location.href = './Unit_Enrollment.php';</script>";
            exit(); 
        }else{    
            //Alert Data detele successfully and keep in AllocateTeachingStaff.php page
            echo "<script type=\"text/javascript\">window.alert('Remove Succeefully!');
            window.location.href = './AllocateTeachingStaff.php';</script>";                         
        }

    }

    //Line 157 to 320 is about 'Add' button function after click "Add New Tutorial Class" button in Tutorial Allocate tab, it allows users to add a new tutorial class
    if(isset($_POST['add'])){
        //Receive the unit code data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['unitcode'])){
            //Store in variables
            $unit_code = $_POST['unitcode'];
        }
        else{
            //Handle the error 
            echo 'Did not get the unit code!';
            exit();
        }

        //Receive the unit name data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['unitname'])){
            //Store in variables
            $unit_name = $_POST['unitname'];
        }
        else{
            //Handle the error 
            echo 'Did not get the unit name!';
            exit();
        }

        //Receive the activity data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Activity'])){
            //Store in variables
            $Activity = $_POST['Activity'];
        }
        else{
            //Handle the error 
            echo 'Did not get the activity!';
            exit();
        }

        //Receive the tutor data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Tutor'])){
            //Store in variables
            $Tutor = $_POST['Tutor'];
        }
        else{
            //Handle the error 
            echo 'Did not get the tutor!';
            exit();
        }

        //Receive the capacity data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Capacity'])){
            //Store in variables
            $Capacity = $_POST['Capacity'];
        }
        else{
            //Handle the error 
            echo 'Did not get the capacity!';
            exit();
        }

        //Receive the start time data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Start_time'])){
            //Store in variables
            $Start_time = $_POST['Start_time'];
        }
        else{
            //Handle the error 
            echo 'Did not get the start time!';
            exit();
        }

        //Receive the end time data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['End_time'])){
            //Store in variables
            $End_time = $_POST['End_time'];
        }
        else{
            //Handle the error 
            echo 'Did not get the end time!';
            exit();
        }

        //Receive the day data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Day'])){
            //Store in variables
            $Day = $_POST['Day'];
        }
        else{
            //Handle the error 
            echo 'Did not get the day!';
            exit();
        }

        //Receive the campus data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Campus'])){
            //Store in variables
            $Campus = $_POST['Campus'];
        }
        else{
            //Handle the error 
            echo 'Did not get the campus!';
            exit();
        }

        //Receive the location data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Location'])){
            //Store in variables
            $Location = $_POST['Location'];
        }
        else{
            //Handle the error 
            echo 'Did not get the Location!';
            exit();
        }

        //Receive the description data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Description'])){
            //Store in variables
            $Description = $_POST['Description'];
        }
        else{
            //Handle the error 
            echo 'Did not get the Description!';
            exit();
        }
        //SQL query to select this input activity value
        $Query = "SELECT * FROM `Tutorials` WHERE `Activity` = '$Activity';";
        
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
            //Check whether this tutorial class has already existed in the table
            if($result_cnt != 0){
                //Automatically go back to tutorial allocation page and pass the message
                echo "<script type=\"text/javascript\">window.alert('Already have this tutorial,Please change anthor activity name');window.location.href = './AllocateTeachingStaff.php';</script>";
                exit(); 
            }else{
                //SQL query to insert the data into table
                $insertQuery = "INSERT INTO `Tutorials` (`Activity`,`unit_code`,`unit_name`,`Day`,`Tutor`,`Start_time`,`End_time`,`Location`,`Capacity`,`Campus`,`Description`) VALUE ('$Activity','$unit_code','$unit_name','$Day','$Tutor','$Start_time','$End_time','$Location','$Capacity','$Campus','$Description');";
                
                //Execute query to the database and retrieve the result
                $result = $mysqli->query($insertQuery);
                
                if (!$result){
                    //Handle error
                    printf("Insert Error", $mysqli->error);
                    exit();
                }else{ 
                    //Alert Data add successfully and keep in AllocateTeachingStaff.php page
                    echo "<script type=\"text/javascript\">window.alert('Add Succeefully!');window.location.href = './AllocateTeachingStaff.php';</script>";             

                }   
            }
        }

    }

    //Line 322 to 371 is about "Update" button function in Consulation Time tab, it allows user to change the consultation time
    if(isset($_POST['change'])){
        //Receive the Email data from the form (in AllocateTeachingStaff.php)
        if (isset($_POST['Email'])){
            //Store in variables
            $Email = $_POST['Email'];
        }
        else{
            //Handle the error 
            echo 'Did not get the Email!';
            exit();
        }

        if (isset($_POST['Consultation'])){
            //Store in variables
            $Consultation = $_POST['Consultation'];
        }
        else{
            //Handle the error 
            echo 'Did not get the Consultation!';
            exit();
        }

        //SQL query to select all consultation time from 'Users' table
        $Query = "SELECT * FROM `Users` WHERE `Email`= '$Email';";

        //Execute query to the database and retrieve the result
        $result = $mysqli->query($Query);
        
        if($result){
            //SQL query to update Consultation data 
            $updatequery = "UPDATE `Users` SET `Consultation`='$Consultation' WHERE `Email`= '$Email';";
            
            //Execute query to the database and retrieve the result
            $updateresult = $mysqli->query($updatequery);
            if(!$updateresult){
                //Handly Error
                echo "Update error!";
            }else{
                //Alert Data update successfully and keep in AllocateTeachingStaff.php Page
                echo "<script type=\"text/javascript\">window.alert('Update consultation time succeefully!');window.location.href = './AllocateTeachingStaff.php';</script>"; 

            }
        }else{
            //handly error
            echo "Select Wrong!";
        }
    }
    
    // Close the connection
    $mysqli->close();

?>
   