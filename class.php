<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$number = $_POST['number'];
$gender = $_POST['gender'];
$date = date('Y-m-d',strtotime($_POST['date']));

$conn = new mysqli("localhost","root","","class");
if(mysqli_connect_error())
{
    die("not able to connect at that moment please try after some time<br>");
}
else{
    $SELECT = "SELECT email FROM wed WHERE email = ? LIMIT 1";
    $INSERT = "INSERT INTO wed(first_name,last_name,email,contact_no,gender,date)
    VALUES(?,?,?,?,?,?)";
    
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows();
    if($rnum==0){
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("ssssss",$firstname,$lastname,$email,$number,$gender,$date);
        $stmt->execute();
        echo "data uploded !";
    }
    else{
        echo "Already applied with this mail id";
    }
}
?>