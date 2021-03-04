<?php
//This page is about user change password database engine
    
    //db connection
    include('db_conn.php'); 

    //Include the file session.php
    include("session.php");

    $emailaddress = $_SESSION['session_user'];

    if (isset($_POST['NewPassword'])){
        $NewPassword = $_POST['NewPassword'];
    }
    else{
        // Handle the error 
        echo 'Did not get the New Password!';
        exit();
    }


    //Hash Password
    $salt = '$2y$07$MyStrongSecretSaltisHere';
    $hashed_password = crypt($NewPassword,$salt);
    

   
    //SQL query to update data into table
    $insertQuery = "UPDATE `Users` SET UserPassword = '$hashed_password' WHERE `Email`='$emailaddress' ;";
    
    $result = $mysqli->query($insertQuery);
       

    // handle error
    if (!$result){
        printf("Error", $mysqli->error);
        exit();
    }else{ 
        //Alert change password successfully and go back to login again
        echo "<script type=\"text/javascript\">window.alert('Change Succeefully!');
        window.location.href = './Login.php';</script>"; 

            
    }
    
    // Close the connection
    $mysqli->close();

?>
   