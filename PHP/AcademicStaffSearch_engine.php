<?php
//This is about search staff function database engine in Academic_Staff.php page
    
    //db connection
    include('db_conn.php'); 

    //receive the search term data from the form (in Academic_Staff.php)
    if (isset($_GET['search_term'])){
        //store in variables
        $search = ($_GET['search_term']);
    }else{
        // Handle the error 
        echo'Did get search term';
    }

    //SQL query to compare search term with 'Users' table's content in database
    $query = "SELECT * FROM `Users`
        WHERE `user_id` LIKE '%$search%'
        OR `user_name` LIKE '%$search%'
        OR `Email` LIKE '%$search%'
        OR `Qualification` LIKE '%$search%'
        OR `Consultation` LIKE '%$search%'
        OR `Teach_Unit` LIKE '%$search%'
        OR `Role_Level` LIKE '%$search%'
        OR `Expertise` LIKE '%$search%';";

    //Execute query to the `Users` table and retrieve the result 
    $result = $mysqli->query($query);
    
    //The number of result rows
    $result_cnt = $result->num_rows;

    //If data returned, Output data as HTML
    if ($result_cnt!=0){
        //produce the output
        echo "<h6>"."We found ".$result_cnt." result(s)"."</h6>";
        echo'<div class="table-responsive">';
        echo '<table id="AcademicStaff_table" class="table">
                    <thead>
                        <tr class="text-left">
                            <th scope="col">Staff ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Qualification</th>
                            <th scope="col">Expertise</th>
                            <th scope="col">Consultation</th>
                            <th scope="col">Teaching Unit</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>   
                        </tr>
                    </thead>';
    
                    while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        echo '<tr class="text-left">
                                <td>'.$row["user_id"].'</td>
                                <td>'.$row["user_name"].'</td>
                                <td>'.$row["Email"].'</td>
                                <td>'.$row["Qualification"].'</td>
                                <td>'.$row["Expertise"].'</td>
                                <td>'.$row["Consultation"].'</td>
                                <td>'.$row["Teach_Unit"].'</td>
                                <td>'.$row["Role_Level"].'</td> 
                                
                            </tr>';                              
                    }
        echo "</table>";
        echo "</div>";
        ?>

        <!--Using Tableedit plugin script-->
        <script src="../JS/jquery.tabledit.js"></script>
        <script src="../JS/jquery.tabledit.min.js"></script>
        <script type="text/javascript" src="../JS/AcademicStaff_Edit.js"></script>
        
        <?php
        echo "</html>";

        // Close the connection
        $mysqli->close();
        
    }else{
        echo "No";
    }

?>