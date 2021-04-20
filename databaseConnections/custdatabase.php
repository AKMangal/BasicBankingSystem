<?php
function OpenCon()
{
    $host        = "host = ec2-3-91-127-228.compute-1.amazonaws.com";
    $port        = "port = 5432";
    $dbname      = "dbname = dcsu66vjdp7ee3";
    $credentials = "user = qrbvmikpodqbhf password= ceeda4391fabf128f5fca009024722229c69c8661839f64bea30429b9e3d382b";

    $conn = pg_connect("$host $port $dbname $credentials");
    if (!$conn) {
        return "Error : Unable to open database\n";
    } else {
        return $conn;
    }
    # $servername = "ec2-3-91-127-228.compute-1.amazonaws.com";
    # $username = "qrbvmikpodqbhf";
    # $password = "ceeda4391fabf128f5fca009024722229c69c8661839f64bea30429b9e3d382b";
    # $dbname = "dcsu66vjdp7ee3";

    #Create Connection and Check it
    #$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n" . $conn->error);

}

function CloseCon($conn)
{
    $conn->close();
}

?> 