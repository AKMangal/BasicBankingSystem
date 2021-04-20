<?php echo file_get_contents("html/header1.html"); ?>
<title> Transaction History </title>
<?php echo file_get_contents("html/header2.html"); ?>
<?php echo "<h2> Transaction History </h2>" ?>

<?php
include 'databaseConnections/custdatabase.php';
$conn = OpenCon();

$sql = "SELECT * FROM transdet";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
?>
    <table class="styled-table">
        <thead>
            <th>Index No.</th>
            <th>Payer Account No.</th>
            <th>Payee Account No.</th>
            <th>Amount Transferred</th>
            <th>Transaction Date & Time</th>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row["Id"] ?></td>
                    <td><?php echo $row["PayerAccNo"] ?></td>
                    <td><?php echo $row["PayeeAccNo"] ?></td>
                    <td><?php echo $row["Amount"] ?></td>
                    <td><?php echo $row["Transaction"] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
    echo "0 results";
}
CloseCon($conn);
?>

<?php echo file_get_contents("html/footer.html"); ?>