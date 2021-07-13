<?php
$email = $_POST['email'];
$textarea = $_POST['textarea'];
//echo $firstname;
//echo $lastname;
//echo $username;
//echo $email;
//echo $password;
$conn = new mysqli("localhost","root","","shadow");
if(mysqli_connect_error())
{
    die("not able to connect at that moment please try after some time<br>");
}
else{
    $SELECT = "SELECT email FROM feedback WHERE email = ? LIMIT 1";
    $INSERT = "INSERT INTO feedback(email,feedback)
    VALUES(?,?)";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows();
    if($rnum==0){
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("ss",$email,$textarea);
        $stmt->execute();
        echo "data uploded";
    }
    else{
        $script = file_get_contents('feedback.js');
        echo "<script>".$script."</script>";
    }
}
?>