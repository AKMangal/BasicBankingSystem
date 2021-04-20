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
$sql1 = "SELECT * FROM custdet WHERE AccountNo = \"$payeraccno\"";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
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
                while ($row = $result1->fetch_assoc()) {
                ?>
                    <td><?php echo $row["AccountNo"]; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["CurrentBalance"];
                        $payerbal = $row["CurrentBalance"]; ?></td>
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
$sql = "UPDATE custdet SET CurrentBalance = $payerbal-$amount WHERE AccountNo = \"$payeraccno\"";

if ($conn->query($sql) === FALSE) {
    echo "Error updating record: " . $conn->error;
}
?>

<?php
$sql2 = "SELECT * FROM custdet WHERE AccountNo = \"$payeeaccno\"";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
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
                while ($row = $result2->fetch_assoc()) {
                ?>
                    <td><?php echo $row["AccountNo"]; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["CurrentBalance"];
                        $payeebal = $row["CurrentBalance"]; ?></td>
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
$sql = "UPDATE custdet SET CurrentBalance = $payeebal+$amount WHERE AccountNo = \"$payeeaccno\"";

if ($conn->query($sql) === FALSE) {
    echo "Error updating record: " . $conn->error;
}
CloseCon($conn);
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
$sql = "INSERT INTO transdet(PayerAccNo, PayeeAccNo, Amount) VALUES (?, ?, ?)";
if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssd", $PayerAccNo, $PayeeAccNo, $Amount);

    // Set parameters
    $PayerAccNo = $payeraccno;
    $PayeeAccNo = $payeeaccno;
    $Amount = $amount;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt) === FALSE) {
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
    }
} else {
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}
$stmt->close();
CloseCon($conn);
?>
<?php echo file_get_contents("html/footer.html"); ?>