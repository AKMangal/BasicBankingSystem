<?php echo file_get_contents("html/header1.html"); ?>
<title> Home Page </title>
<?php echo file_get_contents("html/header2.html"); ?>
<h2><?php echo "Welcome to Sparks Bank!" ?></h2>
<div class="about">
    <b>About Us</b><br>
    Banks play an important role in financial stability, and the economy of a country.
    Most jurisdictions exercise a high degree of regulaisation over banks.
    Most countries have institutionalized a system known as fractional reserve banking, under 
    which banks hold liquid assets equal only to a portion of their current liabilities. 
    In addition to other regulations intended to ensure liquidity, banks are generally subject 
    to minimum capital requirements based on an international set of capital standards, the Basei Accords.
</div>
<div class="row">
    <div class="column">
        <div class="extra-card"></div>
    </div>
    <div class="column">
        <div class="card">
            <img src="img/user.jpg" alt="Customer" style="width:100%">
            <form action="customerpage.php" method="POST">
                <button class="button">View Customer</button>
            </form>
        </div>
    </div>

    <div class="column">
        <div class="card">
            <img src="img/transfer.jpg" alt="Transfer" style="width:100%">
            <form action="transferpage.php" method="GET">
                <button class="button">Fund Transfer</button>
            </form>
        </div>
    </div>

    <div class="column">
        <div class="card">
            <img src="img/history.jpg" alt="History" style="width:100%">
            <form action="historypage.php" method="POST">
                <button class="button">Transaction History</button>
            </form>
        </div>
    </div>

</div>

<?php echo file_get_contents("html/footer.html"); ?>