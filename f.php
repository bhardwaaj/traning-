<?php
$conn = new mysqli("localhost","root","","class");
if(mysqli_connect_error())
{
    die("not able to connect at that moment please try after some time<br>");
}
else{
    echo "done";
}
?>