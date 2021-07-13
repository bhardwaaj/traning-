<?php 
$username = $_POST['username'];
$password = $_POST['password']; 
$conn = new mysqli("localhost","root","","shadow");
// connection error check! 
if($conn->connect_error){
    die("failed to connect");
}else{
    $stmt = "select * from users where username='".$username."'";
    $tbl = mysqli_query($conn,$stmt);
    if(mysqli_num_rows($tbl)>0){
        // a email user found !
        $rows = mysqli_fetch_array($tbl);
        $password_hash = $rows['password'];
        if(password_verify($password,$password_hash))
        {
            // psaaword hash found!
            $script = file_get_contents('login1.js');
            echo "<script>".$script."</script>";
        }
        else{
            $script = file_get_contents('login.js');
            echo "<script>".$script."</script>";
        }
    }
}
?>