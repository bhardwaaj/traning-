<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$course= $_POST['course'];
$date=$_POST['date'];
$months=$_POST['months'];
$years=$_POST['years'];
//echo $firstname;
//echo $lastname;
//echo $username;

$conn = new mysqli("localhost","root","","shadow");
if(mysqli_connect_error())
{
    die("not able to connect at that moment please try after some time<br>");
}
else{
    $SELECT = "SELECT email FROM applications WHERE email = ? LIMIT 1";
    $INSERT = "INSERT INTO applications(first_name,last_name,email,contact_no,course,date,month,year)
    VALUES(?,?,?,?,?,?,?,?)";


    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows();
    if($rnum==0){
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("ssssssss",$firstname,$lastname,$email,$contact,$course,$date,$months,$years);
        $stmt->execute();
        $script = file_get_contents('feedback.js');
        echo "<script>".$script."</script>";
    }
    else{
        echo "Already requested !";
    }
}
?>