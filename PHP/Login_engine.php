<?php
//This file is about login page dababase engine (Login.php).

    //Include the file session.php
    include("session.php");

    //db connection
    include('db_conn.php'); 

    //Receive the email data from the form (in Login.php)
    if (isset($_POST['email'])){
        $emailaddress = $_POST['email'];
    }
    else{
        //Handle the error 
        echo 'Did not get the your email address!';
        exit();
    }

    //Receive the password data from the form (in Login.php)
    if (isset($_POST['password'])){
        $password = $_POST['password'];
    }
    else{
        //Handle the error 
        echo 'Did not get the password!';
        exit();
    }
   

    //SQL query to check whether Email is in the table
    $query = "SELECT * FROM `Users` WHERE `Email`='$emailaddress';";
    
    //Execute query to the database and retrieve the result ($result)
    $result = $mysqli->query($query);
       
    //Convert the result to array 
    $row=$result->fetch_array(MYSQLI_ASSOC);
    
    if (!$result){
        //Handle error
        printf("Error", $mysqli->error);
        exit();
    }
    else{ 
        //if the Email from `Users` table is not same as the Email data from the Login form
        if($row['Email']!=$emailaddress){
            //Automatically go back to login page and pass the error message
            echo "<script type=\"text/javascript\">window.alert('Do not have a record');window.location.href = './Login.php';</script>"; 
            exit();
        }
        //If the Email is the same as the Email data from the Login form
        else {
            $hashed_password = $row['UserPassword'];
            if(hash_equals($hashed_password,crypt($password,$hashed_password))){

                //save the name in the session
                $session_name=$row['user_name'];
                $_SESSION['session_name']=$session_name;
           
                //save the Email as the user in the session
                $session_user=$row['Email'];
                $_SESSION['session_user']=$session_user;
                    
                //save the Role_Level as the access level in the session
                $session_access=$row['Role_Level'];
                $_SESSION['session_Role']=$session_access;
                
                //Automatically go to Home.php    
                header('Location: ./Home.php');
                
            }
            //If the password from database Users table does not match with the password data from the Login form
            else{
                //Automatically go back to signin_form and pass the error message
                echo "<script type=\"text/javascript\">window.alert('Invalid Password');window.location.href = './Login.php';</script>"; 
                exit();
            }
        }
        
    }
    
    // Close the connection
    $mysqli->close();

?>
   