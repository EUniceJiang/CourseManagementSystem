<?php
//This is about search unit function database engine in Unit_Management.php page
    
    //db connection
    include('db_conn.php'); 

    //Receive the search term data from the form (in Unit_Management.php)
    if (isset($_GET['search_term'])){
        //Store in variables
        $search = ($_GET['search_term']);
    }else{
        //Handle the error 
        echo'Did get search term!';
    }

    //SQL query to compare search term with 'Units' table's content in database
    $query = "SELECT * FROM `Units`
        WHERE `unit_code` LIKE '%$search%'
        OR `unit_name` LIKE '%$search%'
        OR `unit_coordinator` LIKE '%$search%'
        OR `semester` LIKE '%$search%'
        OR `campus` LIKE '%$search%';";

    //Execute query to the `Units` table and retrieve the result 
    $result = $mysqli->query($query);

    //The number of result rows
    $result_cnt = $result->num_rows;

    //If data returned, Output data as HTML
    if ($result_cnt!=0){
        //Produce the output
        echo "<h6>"."We found ".$result_cnt." result(s)"."</h6>";
        echo'<div class="table-responsive">';
        echo '<table id="manage_table" class="table">
                    <thead>
                        <tr class="text-left">
                            <th scope="col">Unit Code</th>
                            <th scope="col">Unit Name</th>
                            <th scope="col">Unit Coordinator</th>
                            <th scope="col">Semester</th>                         
                            <th scope="col">Campus</th>
                            <th scope="col">Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>';
    
                    while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        echo '<tr class="text-left">
                                <td>'.$row["unit_code"].'</td>
                                <td>'.$row["unit_name"].'</td>
                                <td>'.$row["unit_coordinator"].'</td>
                                <td>'.$row["semester"].'</td>
                                <td>'.$row["campus"].'</td>
                                <td>'.$row["Unit_description"].'</td>
                                
                            </tr>';                              
                    }
        echo "</table>";
        echo "</div>";
        ?>

        <!--Using Tableedit plugin script-->
        <script src="../JS/jquery.tabledit.js"></script>
        <script src="../JS/jquery.tabledit.min.js"></script>
        <script type="text/javascript" src="../JS/MasterUnit_Edit.js"></script>
        <?php
        echo "</html>";

        //Close the connection
        $mysqli->close();

    }else{
        echo "No";
    }

?>