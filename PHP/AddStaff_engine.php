<?php
//This .php is about Academic_Staff.php page "add a new staff" button datatase engine 
    
    //db connection
    include('db_conn.php'); 

    //receive the username data from the form (in Academic_Staff.php)
    if (isset($_POST['user_name'])){
        //store in variables
        $user_name = $_POST['user_name'];
    }
    else{
        // Handle the error 
        echo 'Did not get the name!';
        exit();
    }

    //receive the user id data from the form (in Academic_Staff.php)
    if (isset($_POST['user_id'])){
        //store in variables
        $user_id = $_POST['user_id'];
    }
    else{
        // Handle the error 
        echo 'Did not get the user id!';
        exit();
    }

    //receive the Email data from the form (in Academic_Staff.php)
    if (isset($_POST['Email'])){
        //store in variables
        $Email = $_POST['Email'];
    }
    else{
        // Handle the error 
        echo 'Did not get the Email address!';
        exit();
    }

    //receive the Qualification data from the form (in Academic_Staff.php)
    if (isset($_POST['Qualification'])){
        //store in variables
        $Qualification = $_POST['Qualification'];
    }
    else{
        // Handle the error 
        echo 'Did not get the qualification!';
        exit();
    }

    //receive the Expertise data from the form (in Academic_Staff.php)
    if (isset($_POST['Expertise'])){
        //store in variables
        $Expertise = $_POST['Expertise'];
    }
    else{
        // Handle the error 
        echo 'Did not get the expertise!';
        exit();
    }

    //receive the Consultation data from the form (in Academic_Staff.php)
    if (isset($_POST['Consultation'])){
        //store in variables
        $Consultation = $_POST['Consultation'];
    }
    else{
        // Handle the error 
        echo 'Did not get the consultation!';
        exit();
    }

    //receive the Role data from the form (in Academic_Staff.php)
    if (isset($_POST['Role'])){
        //store in variables
        $Role = $_POST['Role'];
       
    }
    else{
        // Handle the error 
        echo 'Did not get the Role!';
        exit();
    }

    //SQL query to check whether is staff already existing in database after getting all data and store in variables
    $query = "SELECT * FROM `Users` WHERE `Email`='$Email';";
    
    //Execute query to the Users table and retrieve the result 
    $selectresult = $mysqli->query($query);

    //convert the selectresult to array 
    $row=$selectresult->fetch_array(MYSQLI_ASSOC);
    
    //The number of rows
    $result_cnt = $selectresult->num_rows;

    if($selectresult){
        //If the row count is zero, then insert the new staff data into database
        if($result_cnt == 0){
            
            //SQL query to insert the data into 'Users' table
            $insertQuery = "INSERT INTO `Users` (`user_id`,`user_name`,`Email`,`Qualification`,`Expertise`,`Consultation`,`Role_Level`) VALUES ('$user_id','$user_name','$Email','$Qualification','$Expertise','$Consultation','$Role');";
            
            //Execute query to the Users table and retrieve the result 
            $result = $mysqli->query($insertQuery);
            
            if (!$result){
                // handle error
                printf("Insert Error", $mysqli->error);
                exit();
            }else{ 
                //Alert Data add successfully and keep in Academic_Staff page
                echo "<script type=\"text/javascript\">window.alert('Add Staff Succeefully!');window.location.href = './Academic_Staff.php';</script>"; 
            }
        
        //If the row count is not zero, add unsuccessful and show alert message
        }else{
            //Alert staff existing message and keep in Academic_Staff page
            echo "<script type=\"text/javascript\">window.alert('The staff is existing, the email should be unique');window.location.href = './Academic_Staff.php';</script>"; 

        }
        
    }else{
        // handle error
        echo "Select user wrong!";

    }

    // Close the connection
    $mysqli->close();

?>
   