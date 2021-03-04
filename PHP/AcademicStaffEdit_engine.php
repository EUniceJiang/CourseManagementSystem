<?php
//This is about edit or delete staff records function database engine for Academic_Staff.php page

    //db connection
    include('db_conn.php'); 

    header('Content-Type: application/json');

    $input = filter_input_array(INPUT_POST);

    if ($input['action'] == 'edit') {
        $mysqli->query("UPDATE `Users` SET user_name='" . $input['user_name'] . "', Email='" . $input['Email'] . "', Qualification='" . $input['Qualification'] . "', Expertise='" .$input['Expertise']."', Consultation='".$input['Consultation']."', Teach_Unit='".$input['Teach_Unit']."', Role_Level='".$input['Role_Level']."' WHERE user_id='" . $input['user_id'] . "'");
    } else if ($input['action'] == 'delete') {
        $mysqli->query("DELETE FROM `Users` WHERE user_id='" . $input['user_id'] . "'");
    } 

    mysqli_close($mysqli);

    echo json_encode($input);
?>