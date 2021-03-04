<?php
//This file is about Staff register database engine (For Registration.php page)

    //Include the file session.php
    include("session.php");
    
    //db connection
    include('db_conn.php'); 

    //Receive the staff id data from the form (in Registration.php)
    if (isset($_POST['StaffID'])){
        //Store in variables
        $useid = $_POST['StaffID'];
    }
    else{
        //Handle the error 
        echo 'Did not get the Staff ID!';
        exit();
    }

    //Receive the staff name data from the form (in Registration.php)
    if (isset($_POST['StaffName'])){
        //Store in variables
        $name = $_POST['StaffName'];
    }
    else{
        //Handle the error 
        echo 'Did not get the staff name!';
        exit();
    }


    //Receive the staff email data from the form (in Registration.php)
    if (isset($_POST['StaffEmail'])){
        //Store in variables
        $Email = $_POST['StaffEmail'];
    }
    else{
        //Handle the error 
        echo 'Did not get the Email address!';
        exit();
    }

    $address = $_POST['StaffAddress'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $zip = $_POST['Zip'];
    $phone = $_POST['StaffPhone'];
    $dob = $_POST['StaffDOB'];

    //Receive the qualification data from the form (in Registration.php)
    if (isset($_POST['Qualification'])){
        //Store in variables
        $Qualification = $_POST['Qualification'];
    }
    else{
        //Handle the error 
        echo 'Did not get the Qualification!';
        exit();
    }

    //Receive the expertise data from the form (in Registration.php)
    if (isset($_POST['Expertise'])){
        //Store in variables
        $Expertise = $_POST['Expertise'];
    }
    else{
        //Handle the error 
        echo 'Did not get the Expertise!';
        exit();
    }

    //Receive the role data from the form (in Registration.php)
    if (isset($_POST['Role'])){
        //Store in variables
        $Role = $_POST['Role'];
    }
    else{
        //Handle the error 
        echo 'Did not get the Role!';
        exit();
    }

    //Receive the staff password data from the form (in Registration.php)
    if (isset($_POST['StaffPassword'])){
        //Store in variables
        $password = $_POST['StaffPassword'];
    }
    else{
        //Handle the error 
        echo 'Did not get the password!';
        exit();
    }

    //Hash the password
    $salt = '$2y$07$MyStrongSecretSaltisHere';
    $hashed_password = crypt($password,$salt);


    //SQL query to check whether the username has been signed up
    $query = "SELECT * FROM `Users` WHERE `Email`='$Email';";

    //Execute query to the database and retrieve the result ($Selectresult)
    $Selectresult = $mysqli->query($query);
    
    //Convert the Selectresult to array 
    $row=$Selectresult->fetch_array(MYSQLI_ASSOC);

    //The number of result rows
    $result_cnt = $Selectresult->num_rows;

    
    if (!$Selectresult){
        //Handle error
        printf("Select Error", $mysqli->error);
        exit();
    }else{ 
        //Check whether the register name already exist in the database
        if($result_cnt != 0){
            //Automatically go back to register page and pass the message
            echo "<script type=\"text/javascript\">window.alert('Email Exist,Please choose a new Email address ');window.location.href = './Registration.php';</script>";
            exit(); 
        }else{
            //SQL query to insert the data into table
            $insertQuery = "INSERT INTO `Users` (`user_id`,`user_name`,`Email`,`Address`,`City`,`State`,`Zip`,`Phone`,`dob`,`Qualification`,`Expertise`,`UserPassword`,`Role_Level`) VALUE ('$useid','$name','$Email','$address','$city','$state','$zip','$phone','$dob','$Qualification','$Expertise','$hashed_password','$Role');";
    
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
   
   