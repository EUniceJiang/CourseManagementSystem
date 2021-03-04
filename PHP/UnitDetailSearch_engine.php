<?php
//This page is about search button function database engine (For Unit_Detail.php page)

    //db connection
    include('db_conn.php'); 

    //Receive the search term data from the form (in Unit_Detail.php)
    if (isset($_GET['search_term'])){
        //Store in variables
        $search = ($_GET['search_term']);
    }else{
        //Handle the error 
        echo 'Did get search term!';
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
        //produce the output
        echo "<html>";
            echo "<body>";
                echo "<p>"."We found ".$result_cnt." result(s)"."</p>";

        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                echo "<table>";                
                    echo "<tr>";
                        echo "<th> Unit Code </th>";
                        echo "<td>".$row['unit_code']."</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<th> Unit Name </th>";
                        echo "<td>".$row['unit_name']."</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<th> Unit Coordinator </th>";
                        echo "<td>".$row['unit_coordinator']."</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<th> Semester </th>";
                        echo "<td>".$row['semester']."</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                        echo "<th> Campus </th>";
                        echo "<td>".$row['campus']."</td>";
                    echo "</tr>";

                
                    echo "<br>";
                
                echo "</table>";
            
            echo "</body>";
        echo "</html>";
                
        }

        //Close the connection
        $mysqli->close();

    }else{
        echo "No";
    }

?>