<?php echo file_get_contents("html/header1.html"); ?>
    <title> Customer Page </title>
<?php echo file_get_contents("html/header2.html"); ?>
    <?php echo "<h2>List of Customers!</h2>" ?>
    <?php
        include 'databaseConnections/custdatabase.php';
        $conn = OpenCon();

        $sql = "SELECT * FROM custdet";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
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
                        while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["SerialNo"] ?></td>
                        <td><?php echo $row["AccountNo"] ?></td>
                        <td><?php echo $row["Name"] ?></td>
                        <td><?php echo $row["Email"] ?></td>
                        <td><?php echo $row["CurrentBalance"] ?></td>
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