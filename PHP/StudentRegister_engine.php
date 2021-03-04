<?php
//This file is about Student Register database engine (For Registration.php page)

    //Include the file session.php
    include("session.php");

    //db connection
    include('db_conn.php'); 

    //Receive the student ID data from the form (in Registration.php)
    if (isset($_POST['studentID'])){
        //Store in variables
        $useid = $_POST['studentID'];
    }
    else{
        //Handle the error 
        echo 'Did not get the Student ID!';
        exit();
    }

    //Receive the student name data from the form (in Registration.php)
    if (isset($_POST['StudentName'])){
        //Store in variables
        $name = $_POST['StudentName'];
    }
    else{
        //Handle the error 
        echo 'Did not get the Student Name!';
        exit();
    }


    //Receive the student Email data from the form (in Registration.php)
    if (isset($_POST['StudentEmail'])){
        //Store in variables
        $Email = $_POST['StudentEmail'];
    }
    else{
        //Handle the error 
        echo 'Did not get the Email address!';
        exit();
    }

    $address = $_POST['Address'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $zip = $_POST['Zip'];
    $phone = $_POST['Phone'];
    $dob = $_POST['DOB'];

    //Receive the student login password data from the form (in Registration.php)
    if (isset($_POST['StudentPassword'])){
        $password= $_POST['StudentPassword'];
    }
    else{
        //Handle the error 
        echo 'Did not get the password!';
        exit();
    }

    //Hash the password
    $salt = '$2y$07$MyStrongSecretSaltisHere';
    $hashed_password = crypt($password,$salt);
    

    //SQL query to check whether this Email address has been signed up
    $query = "SELECT * FROM `Users` WHERE `Email`='$Email';";

    //Execute query to the database and retrieve the result ($Selectresult)
    $Selectresult = $mysqli->query($query);
    
    //Convert the Selectresult to array 
    $row=$Selectresult->fetch_array(MYSQLI_ASSOC);

    //The number of rows
    $result_cnt = $Selectresult->num_rows;

    
    if (!$Selectresult){
        //Handle error
        printf("Error", $mysqli->error);
        exit();
    }else{ 
        //Check whether the database has this register email
        if($result_cnt != 0){
            //Automatically go back to Registration page and pass the message
            echo "<script type=\"text/javascript\">window.alert('Email Exist,Please choose a new Email address ');window.location.href = './Registration.php';</script>";
            exit(); 
        }else{
            //SQL query to insert the data into table
            $insertQuery = "INSERT INTO `Users` (`user_id`,`user_name`,`Email`,`Address`,`City`,`State`,`Zip`,`Phone`,`dob`,`UserPassword`,`Role_Level`) VALUE ('$useid','$name','$Email','$address','$city','$state','$zip','$phone','$dob','$hashed_password','Student');";
    
            //Execute query to the database and retrieve the result ($result)
            $result = $mysqli->query($insertQuery);

            if(!$result){
                //Handle error
                printf("Insert SQL Error", $mysqli->error);
                exit();
            }else{                    
                //Alert register successfully and go to login page        
                echo "<script type=\"text/javascript\">window.alert('Register Succeefully! Please Login agin!');window.location.href = './Login.php';</script>"; 
                exit();
            }

        }
            
    }
   
    // Close the connection
    $mysqli->close();

?>
   