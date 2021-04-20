<?php echo file_get_contents("html/header1.html"); ?>
<title> Successful </title>
<?php echo file_get_contents("html/header2.html"); ?>

<?php
include 'databaseConnections/custdatabase.php';
$conn = OpenCon();
session_start();
$payeraccno = $_SESSION["payer"];
$payeeaccno = $_SESSION["payee"];
$amount = $_SESSION["amt"];
$sql1 = "SELECT * FROM custdet WHERE AccountNo = \'$payeraccno\'";
$result1 = pg_query($conn, $sql1);
if ($result1) {
?>
    <table class="styled-table" style="width: 60%">
        <thead>
            <tr>
                <th colspan="4">Payer Details</th>
            </tr>
            <tr style="background-color: rgba(17, 124, 143, .5)">
                <th>Account No.</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Current Balance</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center">
                <?php
                while ($row = pg_fetch_row($result1)) {
                ?>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><?php echo $row[4];
                        $payerbal = $row[4]; ?></td>
                <?php
                }
                ?>
            </tr>
        </tbody>
    </table>
<?php
} else {
    echo "0 results";
}
$sql = "UPDATE custdet SET CurrentBalance = $payerbal-$amount WHERE AccountNo = \'$payeraccno\'";

if (pg_query($conn, $sql) === FALSE) {
    echo "Error updating record: " . pg_last_error($conn);
}
?>

<?php
$sql2 = "SELECT * FROM custdet WHERE AccountNo = \'$payeeaccno\'";
$result2 = pg_query($conn, $sql2);
if ($result2) {
?>
    <table class="styled-table" style="width: 60%">
        <thead>
            <tr>
                <th colspan="4">Payee Details</th>
            </tr>
            <tr style="background-color: rgba(17, 124, 143, .5)">
                <th>Account No.</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Current Balance</th>
            </tr>
        </thead>
        <tbody>
            <tr style="background-color:#f3f3f3; text-align:center">
                <?php
                while ($row = pg_fetch_row($result2)) {
                ?>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><?php echo $row[4];
                        $payeebal = $row[4]; ?></td>
                <?php
                }
                ?>
            </tr>
        </tbody>
    </table>
<?php
} else {
    echo "0 results";
}
$sql = "UPDATE custdet SET CurrentBalance = $payeebal+$amount WHERE AccountNo = \'$payeeaccno\'";

if (pg_query($conn, $sql) === FALSE) {
    echo "Error updating record: " . pg_last_error($conn);
}
pg_close($conn);
?>
<table class="styled-table" style="text-align:center; width: 200px; height: 200px">
    <thead>
        <th></th>
        <th>Old Balance</th>
        <th>New Balance</th>
    </thead>
    <tbody>
        <tr>
            <th>Payer</th>
            <td><?php echo $payerbal ?></td>
            <td><?php echo $payerbal - $amount ?></td>
        </tr>
        <tr>
            <th>Payee</th>
            <td><?php echo $payeebal ?></td>
            <td><?php echo $payeebal + $amount ?></td>
        </tr>
    </tbody>
</table>
<?php
$conn = OpenCon();

// Prepare an insert statement
$sql = "INSERT INTO transdet(PayerAccNo, PayeeAccNo, Amount) VALUES (:payeraccno, :payeeaccno, :amount)";
if ($stmt = $this->pdo->prepare($sql)) {
    
    // Set parameters
    $PayerAccNo = $payeraccno;
    $PayeeAccNo = $payeeaccno;
    $Amount = $amount;

    // Bind variables to the prepared statement as parameters
    $stmt->bindValue(':payeraccno', $PayerAccNo);
    $stmt->bindValue(':payeeaccno', $PayeeAccNo);
    $stmt->bindValue(':amount', $Amount);

    // Attempt to execute the prepared statement
    if ($stmt->execute() === FALSE) {
        echo "ERROR: Could not execute query: $sql. " . pg_last_error($conn);
    }
} else {
    echo "ERROR: Could not prepare query: $sql. " . pg_last_error($conn);
}
$stmt->close();
pg_close($conn);
?>
<?php echo file_get_contents("html/footer.html"); ?>