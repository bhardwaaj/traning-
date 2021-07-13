<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password , PASSWORD_DEFAULT);
//echo $firstname;
//echo $lastname;
$conn = new mysqli("localhost","root","","shadow");
if(mysqli_connect_error())
{
    die("not able to connect at that moment please try after some time<br>");
}
else{
    $SELECT = "SELECT email FROM users WHERE email = ? LIMIT 1";
    $INSERT = "INSERT INTO users(first_name,last_name,email,username,password)
    VALUES(?,?,?,?,?)";
    
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows();
    if($rnum==0){
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("sssss",$firstname,$lastname,$email,$username,$hash);
        $stmt->execute();
        $script = file_get_contents('javascriptFile.js');
        echo "<script>".$script."</script>";
    }
    else{
        echo "Already Sign Up with this mail id";
    }
}
?>