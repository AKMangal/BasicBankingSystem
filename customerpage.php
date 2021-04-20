<?php echo file_get_contents("html/header1.html"); ?>
    <title> Customer Page </title>
<?php echo file_get_contents("html/header2.html"); ?>
    <?php echo "<h2>List of Customers!</h2>" ?>
    <?php
        include 'databaseConnections/custdatabase.php';
        $conn = OpenCon();

        $sql = "SELECT * FROM custdet";
        $result = pg_query($conn, $sql);
        
        if ($result) {
            // output data of each row
            ?>
            <table class="styled-table">
                <thead>
                    <th>Serial No.</th>
                    <th>Account No.</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Current Balance</th>
                </thead>
                <tbody>
                    <?php
                        while($row = pg_fetch_row($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["serialno"] ?></td>
                        <td><?php echo $row["accountno"] ?></td>
                        <td><?php echo $row["name"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                        <td><?php echo $row["currentbalance"] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
        } 
        else{
            echo "0 results";
        }
        CloseCon($conn);
    ?>
    
<?php echo file_get_contents("html/footer.html"); ?>