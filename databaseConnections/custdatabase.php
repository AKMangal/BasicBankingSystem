<?php
function OpenCon()
{
    $servername = "localhost";
    $username = "root";
    $password = "uGQjM/dpv6EutseO";
    $dbname = "bankdetails";

    #Create Connection and Check it
    $conn = new mysqli($servername, $username, $password,$dbname) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}
 
function CloseCon($conn)
{
    $conn -> close();
}

?>