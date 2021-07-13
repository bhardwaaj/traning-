<?php
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$msg = $_POST['text_msg'];

$conn = new mysqli("localhost","root","","shadow");
if(mysqli_connect_error())
{
    die("not able to connect at that moment please try after some time<br>");
}
else{
    $SELECT = "SELECT email FROM contact_us WHERE email = ? LIMIT 1";
    $INSERT = "INSERT INTO contact_us(Name,email,contact_no,message)
    VALUES(?,?,?,?)";


    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows();
    if($rnum==0){
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("ssss",$name,$email,$contact,$msg);
        $stmt->execute();
        $script = file_get_contents('contactus.js');
        echo "<script>".$script."</script>";
    }
    else{
        echo "Already Applied for the help , our team will contact you very soon";
    }
}
?>
