<?php
//This file is about my account eidt personal information function database engine

    //db connection
    include('db_conn.php'); 

    header('Content-Type: application/json');

    $input = filter_input_array(INPUT_POST);


    if ($input['action'] == 'edit') {
        $mysqli->query("UPDATE `Users` SET user_name='" . $input['user_name'] . "', Email='" . $input['Email'] . "', Phone='" . $input['Phone'] . "', dob='" .$input['dob']."' WHERE user_id='" . $input['user_id'] . "'");
    } 

    mysqli_close($mysqli);

    echo json_encode($input);
?>